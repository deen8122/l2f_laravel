<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LetterTest extends TestCase {

	use WithoutMiddleware;

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_getLetter() {
		$this->withoutMiddleware();
		$response = $this->get('/api/letter/6');
		$response->assertStatus(200);
		//$response->assertStatus(401);
	}

}
