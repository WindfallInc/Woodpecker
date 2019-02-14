<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	public function submission() {
        return $this->belongsTo('App\Submission');
	}
	public function question() {
        return $this->belongsTo('App\Question');
	}
}
