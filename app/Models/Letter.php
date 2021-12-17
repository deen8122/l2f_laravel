<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
use Str;

class Letter extends Model {

	use HasFactory;

	protected $fillable = [
		'text',
		//'images',
		//'data'
	];

	/*
	 * creating: возникает до операции добавления модели;
	  created: появляется после добавления модели;
	  updating: срабатывает до обновления модели;
	  updated: появляется после обновления;
	  deleting: возникает до удаления;
	  deleted: срабатывает после удаления модели;
	  retrieved: уведомляет об извлечении модели;
	  saving: возникает до создания или обновления модели;
	  saved: срабатывает после создания или обновления модели;
	  restoring: возникает до восстановления модели;
	  restored: появляется после восстановления модели;
	  replicating: сообщает о создании копии модели.
	 */

	public static function boot() {
		parent::boot();

		static::creating(function($item) {
			Log::info('Creating event call: ' . $item);
			$item->id2 = 0;
			$item->created_time = time();
			$item->future_time = time();
			$item->user_id = auth()->user()->id;
		});



		static::created(function($item) {
			Log::info('Created event call: ' . $item);
		});


		static::updating(function($item) {

			Log::info('Updating event call: ' . $item);
			//$item->data = rand(99, 9999) . '==' . Str::slug($item->text);
		});

		static::updated(function($item) {
			Log::info('Updated event call: ' . $item);
		});

		static::deleted(function($item) {
			Log::info('Deleted event call: ' . $item);
		});
	}

	public function user() {
		return $this->belongsTo('App\Models\User');
		//return $this->hasMany('\App\Models\Image');
	}

	public function images() {
		return $this->hasMany('App\Models\Image', 'letter_id', 'id');
		//return $this->hasMany('\App\Models\Image');
	}

	public function saveLetter() {
		
	}

	public function getUserLetter() {
		
	}

}