<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function contents() {
        return $this->belongsToMany('App\Content');
	}
	public function images() {
        return $this->belongsToMany('App\Media');
	}
}
