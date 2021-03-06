<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
	use SoftDeletes;
	public function form() {
        return $this->belongsTo('App\Woodpecker\Form');
	}
	public function children() {
				$children = Question::where('parent_id', $this->id)->get();
        return $children;
	}
	public function parent() {
        return $this->belongsTo('App\Woodpecker\Question');
	}
	public function child() {
        return $this->hasMany('App\Woodpecker\Question');
	}
}
