<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SendingTest extends DuskTestCase {
	/**
	 * A Dusk test example.
	 *
	 * @return void
	 */

	/**	 * A Dusk test example. * * @return void */
	public function test_I_can_login_successfully() {
		$this->browse(function ($browser) {
			$browser->visit('/login')
				->type('email', 'deen812@mail.ru')
				->type('password', 'deen812@mail.ru')
				->press('Login')
			
				->assertPathIs('/dashboard');
		});
	}

	/*
	public function testExample() {
		$this->browse(function (Browser $browser) {
			$browser->visit('/')
				->assertSee('Laravel');
		});
	}

	public function testBasicExample() {

		$user = factory(User::class)->create();
		$this->browse(function ($browser) use ($user) {
			$browser->value('#message', 'Test message YO');
			$browser->click('.send_btn');
		});
	}
	 * 
	 */

}
