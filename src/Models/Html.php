<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Html extends Model
{
	public function content() {
        return $this->belongsTo('App\Woodpecker\Content');
	}
}
