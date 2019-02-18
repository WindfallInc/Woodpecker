<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
	use SoftDeletes;

	protected $touches = ['content'];

	public function content() {
        return $this->belongsTo('App\Woodpecker\Content');
	}
	public function loop($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1);
	}
	public function randLoop($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1)->inRandomOrder();
	}
	public function forms() {
				$forms = Form::all();
				return $forms;
	}
	public function form() {
        return $this->belongsTo('App\Woodpecker\Form');
	}
	public function images() {
        return $this->hasMany('App\Woodpecker\Media');
	}

}
