<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LetterResource extends JsonResource {

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		
		//dd($this->resource->images()->get());
		$images = null;
		if ($this->resource->images()->get()) {
			foreach ($this->resource->images()->get() as &$image) {
				$images[] = Storage::disk('public')->url($image->filename);
			}
		}
		//l($this->resource->images());exit;
		return [
			'id' => $this->id,
			'text' => $this->text,
			'images' => $images,
			'images2' => $this->resource->images()
		];
	}

}
