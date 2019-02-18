<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class CustomFieldContent extends Model
{

	protected $touches = ['content'];

	public function customField() {
        return $this->belongsTo('App\Woodpecker\CustomField');
	}
	public function content() {
        return $this->belongsTo('App\Woodpecker\Content');
	}
}
