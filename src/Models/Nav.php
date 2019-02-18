<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
	public function menu() {
        return $this->belongsTo('App\Woodpecker\Menu');
	}
	public function parent() {
        return $this->belongsTo('App\Woodpecker\Nav');
	}
	public function children() {
				$children = Nav::where('parent_id', $this->id)->get();
        return $children;
	}
}
