<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	public function submission() {
        return $this->belongsTo('App\Woodpecker\Submission');
	}
	public function question() {
        return $this->belongsTo('App\Woodpecker\Question');
	}
}
