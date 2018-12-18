<?php
use App\Template;
use App\Type;
use App\Content;
use App\Category;
use App\Component;
use App\Menu;
use App\Nav;

function loop($type)
{
  $type =  Type::where('slug', $type)->first();
  return $type->contents->where('published', 1);
};

function loopByCat($cat)
{
  $cat  =  Category::with('contents')->where('slug',$cat)->first();
  return $cat->contents->where('published', 1);
}
public function loop3($slug)
{
  $type =  Type::where('slug', $slug)->first();
	return $type->contents->where('published', 1)->sortByDesc('updated_at')->take(3);
}