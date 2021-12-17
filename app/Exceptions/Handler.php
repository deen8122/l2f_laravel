<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register() {
		$this->reportable(function (Throwable $e) {
			//
		});
		$this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
			if ($request->is('api/*')) {
				return response()->json([
						'success' => false,
						'message' => 'Not authenticated',
						], 401);
			}
		});
	}

	public function renderEE($request, Exception $exception) {
		if ($exception instanceof AuthorizationException) {
			return response()->json([
					'message' => 'your error message'
					], 401);
		}

		return parent::render($request, $exception);
	}

	public function renderx($request, Exception $exception) {
		if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
			return response()->json(['message' => 'Not Found!'], 404);
		}
	}

	public function renderК($request, Exception $exception) {
		if ($exception instanceof AuthorizationException) {
			return response()->json([
					'message' => 'Not authenticated'
					], 401);
		}

		return parent::render($request, $exception);
	}

}
