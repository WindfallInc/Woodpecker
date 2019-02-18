<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Row extends Model
{
	use SoftDeletes;

	protected $touches = ['content'];

	public function content() {
        return $this->belongsTo('App\Woodpecker\Content');
	}
	public function components() {
        return $this->belongsToMany('App\Woodpecker\Component');
	}

}
