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
		/*
		 * Если есть PUSH токен сохраняем
		 */
		//log2file('_request', $_POST);
		if ($request->push_token) {
			if (!$user->pushTokens()->exists()) {
				//log2file('_request', $_POST);
				//$user->pushTokens->add($request->push_token);
				\App\Models\Pushtoken::create([
					'token' => $request->push_token,
					'user_id' => $user->id,
					'device' => $request->device_name]);
			}
			//$user->pushTokens->add($request->push_token);
		}

		$token = '';
		if ($user->tokens()->exists()) {
			//$t = $user->tokens()->first();
			$token = $user->tokens()->first()->token;
			
		}else {
			$token = $user->createToken($request->device_name)->plainTextToken;
		}
		return response()->json(['token' => $token]);
	}

	// method for user logout and delete token
	public function logout() {
		auth()->user()->tokens()->delete();

		return [
			'message' => 'You have successfully logged out and the token was successfully deleted'
		];
	}

}
