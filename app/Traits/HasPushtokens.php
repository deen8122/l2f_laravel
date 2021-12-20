<?php

namespace App\Traits;

use App\Project;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasPushtokens {

	public function attachments() {
		return $this->morphToMany(Project::class, 'attachable', 'attachments');
	}

}
