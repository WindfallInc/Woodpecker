<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
	public function questions() {
        return $this->hasMany('App\Woodpecker\Question');
	}
	public function submissions() {
        return $this->hasMany('App\Woodpecker\Submission');
	}
}
