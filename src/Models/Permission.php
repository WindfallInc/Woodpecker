<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	public function user() {
        return $this->belongsTo('App\Woodpecker\Dashboard');
	}
	public function type() {
        return $this->belongsTo('App\Woodpecker\Type');
	}
	public function content() {
        return $this->belongsTo('App\Woodpecker\Template');
	}
}
