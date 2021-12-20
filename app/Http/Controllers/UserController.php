<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Jobs\ProcessSendingEmail;
use Validator;

class UserController extends Controller {

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

	public function profile() {
		return auth()->user();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Letter  $letter
	 * @return \Illuminate\Http\Response
	 */
}
