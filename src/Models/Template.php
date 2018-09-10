<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
	public function types() {
        return $this->belongsToMany('App\Type');
	}
	public function menus() {
				return $this->belongsToMany('App\Menu');
	}
	public function contents() {
				return $this->hasMany('App\Content');
	}
}
