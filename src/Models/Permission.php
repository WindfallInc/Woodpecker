<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	public function user() {
        return $this->belongsTo('App\Dashboard');
	}
	public function type() {
        return $this->belongsTo('App\Type');
	}
	public function content() {
        return $this->belongsTo('App\Template');
	}
}
