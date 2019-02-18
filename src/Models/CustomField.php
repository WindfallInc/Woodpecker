<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
	public function types() {
        return $this->belongsToMany('App\Woodpecker\Type');
	}
	public function customFieldContent() {
        return $this->hasMany('App\Woodpecker\CustomFieldContent');
	}
}
