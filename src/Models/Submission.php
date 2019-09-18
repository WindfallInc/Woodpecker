<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
	use SoftDeletes;
	public function form() {
        return $this->belongsTo('App\Woodpecker\Form');
	}
	public function answers() {
        return $this->hasMany('App\Woodpecker\Answer');
	}
}
