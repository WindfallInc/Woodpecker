<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
	use SoftDeletes;
	public function contents() {
        return $this->hasMany('App\Content');
	}
	public function templates() {
        return $this->belongsToMany('App\Template');
	}
	public function custom_fields() {
        return $this->belongsToMany('App\CustomField');
	}
}
