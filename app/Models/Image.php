<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
use Str;

class Image extends Model {

	use HasFactory;

	public $timestamps = false;
	protected $fillable = [];

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

	public function letter() {
		return $this->belongsTo(\App\Models\Letter::class);
	}

}
