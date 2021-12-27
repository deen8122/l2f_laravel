<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;
use Str;

class Image extends Model {

	use HasFactory;

	public $timestamps = false;
	public $full_path;
	protected $fillable = [];

	public function letter() {
		return $this->belongsTo(\App\Models\Letter::class);
	}

}
