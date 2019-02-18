<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	public function categories() {
        return $this->belongsToMany('App\Woodpecker\Category');
	}
	public function contents() {
        return $this->belongsToMany('App\Woodpecker\Content');
	}
	public function component() {
        return $this->belongsTo('App\Woodpecker\Component');
	}
	public function isdoc() {
				$medias = Media::all();
				// Creates empty collection
        $docs = new \Illuminate\Database\Eloquent\Collection;
				foreach($medias as $media){
					if(!substr($media->path, 0, 5)=='/docs'){
						$docs = $docs->merge($media);
					}
				}

        return $docss;
	}

}
