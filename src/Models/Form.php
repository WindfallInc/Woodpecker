<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
	public function questions() {
        return $this->hasMany('App\Question');
	}
	public function submissions() {
        return $this->hasMany('App\Submission');
	}
}
