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
		return $this->sendResponse($letter->toArray(), 'Item created successfully');
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
	public function show(int $id) {
		$letter = Letter::HasUser(auth()->user()->id)->find($id);
		if (!$letter) {
			return $this->sendError('Item not found', false);
		}
		return $letter;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Letter $letter) {
		return $letter = Letter::where('user_id', $user->id)->find($id);
	}

	/**
	 * Get all not sending letters for current user
	 *
	 * 
	 * @return int
	 */
	public function count() {
		return response()->json(["count" => Letter::HasUser(auth()->user()->id)->count()]);
	}

}
