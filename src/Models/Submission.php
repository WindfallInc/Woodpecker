<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
	public function form() {
        return $this->belongsTo('App\Form');
	}
	public function answers() {
        return $this->hasMany('App\Answer');
	}
}
