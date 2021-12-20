<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushtokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pushtokens', function (Blueprint $table) {
			$table->id();
			//$table->timestamps();
			$table->string('token');
			$table->string('device');
			$table->foreignId('user_id');
			$table->foreign('user_id')->references('id')->on('user')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('pushtoken');
	}

}
