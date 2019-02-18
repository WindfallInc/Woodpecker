<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
	use SoftDeletes;
	public function categories() {
        return $this->belongsToMany('App\Woodpecker\Category');
	}
	public function rows() {
        return $this->hasMany('App\Woodpecker\Row');
	}
	public function customFieldContent() {
        return $this->hasMany('App\Woodpecker\CustomFieldContent');
	}
	public function htmls() {
        return $this->hasMany('App\Woodpecker\Html');
	}
	public function type() {
        return $this->belongsTo('App\Woodpecker\Type');
	}
	public function template() {
        return $this->belongsTo('App\Woodpecker\Template');
	}
	public function components() {
        return $this->hasMany('App\Woodpecker\Component');
	}
	public function media() {
        return $this->belongsToMany('App\Woodpecker\Media');
	}
	public function images() {
        return $this->belongsToMany('App\Woodpecker\Media');
	}
	public function featimg() {
        $featured = $this->images()->where('featured', 1)->first();
				if(isset($featured)){
					$img = $featured->path;
					return $img;
				}
				return '/featured/default.jpg';

	}

	public function excerpt() {
		$row = $this->rows->first();
		$content = strip_tags($row->content);
		$dot = ".";

		$position = stripos ($content, $dot); //find first dot position

		if($position) { //if there's a dot in our soruce text do
				$offset = $position + 1; //prepare offset
				if(stripos ($content, $dot, $offset) !== false){
					$position = stripos ($content, $dot, $offset); //find second dot using offset
				}
				$excerpt = substr($content, 0, $position); //put two first sentences under $first_two

				$excerpt = $excerpt . '.'; //add a dot
				return $excerpt;
		}
		else {  //if there are no dots
				//do nothing
		}
	}

	public function url() {
		$type = $this->type;
		return $type->slug.'/'.$this->slug;

	}

	public function get_the($name) {

				$field = $this->type->custom_fields->where('name',$name)->first();
				if(isset($field)){
					$content = $this->customFieldContent->where('custom_field_id',$field->id)->first();
					if(isset($content)){
						return $content->content;
					} else {
						return '';
					}
				}
				else {
					return '';
				}
	}

	public function loop($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1);
	}
	public function loop3($slug) {
        $type =  Type::where('slug', $slug)->first();
				return $type->contents->where('published', 1)->sortByDesc('updated_at')->take(3);
	}
}
