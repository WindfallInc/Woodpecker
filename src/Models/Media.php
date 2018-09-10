<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	public function categories() {
        return $this->belongsToMany('App\Category');
	}
	public function contents() {
        return $this->belongsToMany('App\Content');
	}
	public function component() {
        return $this->belongsTo('App\Component');
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
