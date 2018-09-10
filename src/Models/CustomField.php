<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
	public function types() {
        return $this->belongsToMany('App\Type');
	}
	public function customFieldContent() {
        return $this->hasMany('App\CustomFieldContent');
	}
}
