<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Jobs\ProcessSendingEmail;
use Validator;

class LetterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = auth()->user();
		$letters = Letter::orderBy('id', 'desc')->where('user_id', $user->id)->paginate(10);
		return response()->json($letters, 200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('letter.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function add(Request $request) {
		$input = $request->all();
		$validator = Validator::make($input, [
				'text' => 'required',
				'future_time' => 'required',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$letter = Letter::create($input);
		$this->saveImages($request, $letter);
		return $this->sendResponse($letter->toArray(), 'Item created successfully.');
	}

	public function saveImages(Request $request, Letter $letter) {
		if ($request->hasFile('images')) {
			$files = $request->file('images');
			foreach ($files as $file) {
				$filenameWithExt = $file->getClientOriginalName();
				$extention = $file->getClientOriginalExtension();
				$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
				$newFileName = $letter->id . '_' . $filename . "." . $extention;
				$fileNameToStore = 'image/' . $newFileName;
				$path = $file->storeAs('public', $fileNameToStore);
				$images = new Image;
				$images->letter_id = $letter->id;
				$images->filename_origin = $filenameWithExt;
				$images->filename = $newFileName;
				$images->save();
			}			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$user = auth()->user();
		$letter = Letter::where('user_id', $user->id)->find($id);
		return $letter;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Letter $letter) {
		$user = auth()->user();
		//dd($user);
		return view('letter.edit', compact('letter'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Letter $letter) {
		/*
		  $request->validate([
		  'title' => 'required',
		  'description' => 'required',
		  ]);
		 */
		$letter->update($request->all());
		$user = auth()->user();
		//\App\Jobs\ProcessSendingEmail::dispatch($user);
		//new \App\Jobs\ProcessSendingEmail($user);
		$this->dispatch(new ProcessSendingEmail($user));
		return redirect()->route('letter.index')->with('success', 'Post updated successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Letter $letter) {
		//
	}

}
