<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pushtoken extends Model {

	public $timestamps = false;
	protected $fillable = [
		'token',
		'device',
		'user_id',
	];

	public static function boot() {
		parent::boot();

		static::creating(function($item) {
			//$item->user_id = \Auth::user()->id;
		});
	}

	public function add(string $pushToken): string {
		log2file('Pushtoken', [$pushToken, $this]);
		return "s";
	}

}
