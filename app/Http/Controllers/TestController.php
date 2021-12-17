<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use App\Jobs\ProcessSendingEmail;

class TestController extends Controller {

	public function userInfo() {
		$user = auth()->user();
		l($user);
	}
	
	
	public function index() {
		$user = auth()->user();
		//$this->dispatch(new ProcessSendingEmail($user));
		$letters = Letter::orderBy('id', 'desc')
			->where('user_id',$user->id)
			->paginate(10); // Трюк для получения пагинатора
		//return view('letter.index')->with('letters', $letters);
		l($letters);
		//return response()->json($letters, 200);
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
	public function store(Request $request) {
		$request->validate([
			'images' => 'required',
			'text' => 'required',
		]);

		$letter =Letter::create($request->all());

		return redirect()->route('letter.edit',$letter)->with('success', 'Post created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
	public function show(Letter $letter) {
		echo '<pre>';
		print_r($letter->id);
		print_r($letter->images);

		$country = Letter::find(1);
		$user = $country->image;
		print_r($user);
		echo '</pre>';
		//exit;
		return view('letter.show', compact('letter'));
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
	public function test() {
		\App\Services\PushService::checkLetters();
	}

}
