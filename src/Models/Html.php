<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Html extends Model
{
	public function content() {
        return $this->belongsTo('App\Content');
	}
}
