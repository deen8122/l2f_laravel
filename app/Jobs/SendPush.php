<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPush implements ShouldQueue {

	use Dispatchable,
     InteractsWithQueue,
     Queueable,
     SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Execute the job.
	 * Метод handle вызывается, когда задание обрабатывается очередью. 
	 * Обратите внимание, что мы можем объявить тип зависимости в методе handle задания. 
	 * Контейнер служб Laravel автоматически внедряет эти зависимости.
	 * @return void
	 */
	public function handle() {
		//
	}

}
