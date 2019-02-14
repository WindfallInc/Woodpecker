<?php
use App\Woodpecker\Template;
use App\Woodpecker\Type;
use App\Woodpecker\Content;
use App\Woodpecker\Category;
use App\Woodpecker\Component;
use App\Woodpecker\Menu;
use App\Woodpecker\Nav;

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
function loop3($slug)
{
  $type =  Type::where('slug', $slug)->first();
	return $type->contents->where('published', 1)->sortByDesc('updated_at')->take(3);
}