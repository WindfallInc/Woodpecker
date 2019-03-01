<?php

namespace App\Woodpecker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
	use SoftDeletes;

	protected $touches = ['content'];

	public function content() {
        return $this->belongsTo('App\Woodpecker\Content');
	}
	public function form() {
        return $this->belongsTo('App\Woodpecker\Form');
	}
	public function category() {
        return $this->belongsTo('App\Woodpecker\Category');
	}
	public function type() {
        return $this->belongsTo('App\Woodpecker\Type');
	}
	public function images() {
        return $this->hasMany('App\Woodpecker\Media');
	}

	public function loop($slug) {
        $type =  Type::where('slug', $slug)->first();
				if(isset($type)){
					if($type->time == 1)
					{
						return $type->contents->where('published', 1)->sortBy('end_date');
					}
					else {
						return $type->contents->where('published', 1)->sortByDesc('updated_at');
					}
				}
				else {
					return false;
				}
	}
	public function randLoop($slug) {
        $type =  Type::where('slug', $slug)->first();
				if(isset($type)){
					return $type->contents->where('published', 1)->inRandomOrder();
				}
				else {
					return false;
				}
	}
	public function loopByCatType($type, $cat) {
        $type =  Type::where('slug', $type)->first();
				if(isset($type)){
					if($type->time == 1)
					{
						return $type->contents->where('published', 1)->whereHas('categories', function ($query) {
	    				$query->where('slug', $cat);
						})->sortBy('end_date');
					}
					else {
						return $type->contents->where('published', 1)->whereHas('categories', function ($query) {
	    				$query->where('slug', $cat);
						})->sortByDesc('updated_at');
					}

				}
				else {
					return false;
				}
	}
	public function loopByCat($cat) {
				$category = Category::where('slug',$cat)->first();
				return $category->contents->where('published', 1)->sortByDesc('updated_at');
	}
	public function forms() {
				$forms = Form::all();
				return $forms;
	}


}
