<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
	public function menu() {
        return $this->belongsTo('App\Menu');
	}
	public function parent() {
        return $this->belongsTo('App\Nav');
	}
	public function children() {
				$children = Nav::where('parent_id', $this->id)->get();
        return $children;
	}
}
