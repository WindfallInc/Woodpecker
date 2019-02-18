<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
	public function types() {
        return $this->belongsToMany('App\Woodpecker\Type');
	}
	public function menus() {
				return $this->belongsToMany('App\Woodpecker\Menu');
	}
	public function contents() {
				return $this->hasMany('App\Woodpecker\Content');
	}
}
