<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function contents() {
        return $this->belongsToMany('App\Woodpecker\Content');
	}
	public function images() {
        return $this->belongsToMany('App\Woodpecker\Media');
	}
	public function components() {
        return $this->hasMany('App\Woodpecker\Component');
	}
}
