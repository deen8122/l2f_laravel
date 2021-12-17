<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

	public function register(Request $request) {
		$validator = Validator::make($request->all(), [
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				'password' => ['required', 'string', 'min:4'],
				'device_name' => ['required', 'string']
		]);
		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 401);
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::create($input);
		$token = $user->createToken($request->device_name)->plainTextToken;
		/*
		 *  return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
		 */
		return response()->json(['token' => $token], 200);
	}

	public function login(Request $request) {
		$validator = Validator::make($request->all(), [
				'email' => ['required', 'string', 'email', 'max:255'],
				'password' => ['required', 'string', 'min:8'],
				'device_name' => ['required', 'string']
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 401);
		}
		$user = User::where('email', $request->email)->first();
		if (!$user || !Hash::check($request->password, $user->password)) {
			return response()->json(['error' => 'Password or Login incorrect'], 401);
		}
		return response()->json(['token' => $user->createToken($request->device_name)->plainTextToken]);
	}

	// method for user logout and delete token
	public function logout() {
		auth()->user()->tokens()->delete();

		return [
			'message' => 'You have successfully logged out and the token was successfully deleted'
		];
	}

}
