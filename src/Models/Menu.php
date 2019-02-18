<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use SoftDeletes;
	public function navs() {
        return $this->hasMany('App\Woodpecker\Nav');
	}
	public function parents() {
        $parents = $this->navs()->whereNull('parent_id')->get();
				return $parents;
	}
	public function templates() {
				return $this->belongsToMany('App\Woodpecker\Template');
	}
}
