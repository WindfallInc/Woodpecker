<?php
/*
* THIS FILE SHOULD NOT BE EDITED
* This file will be overwritten if the cms updates
* to make changes to this file, duplicate it
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Woodpecker\Template;
use App\Woodpecker\Type;
use App\Woodpecker\Content;
use App\Woodpecker\Category;
use App\Woodpecker\Row;
use App\Woodpecker\Component;
use App\Woodpecker\Menu;
use App\Woodpecker\Nav;
use App\Woodpecker\Form;
use App\Woodpecker\Question;
use App\Woodpecker\Submission;
use App\Woodpecker\Answer;
use App\Woodpecker\Html;


use Auth;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
      $page 	 = Content::where('slug','home')->isPublished()->first();
      if(!isset($page)){
        abort(404);
      }
      if(isset($page->template)){
        $template = $page->template;
      }
      else{
        $template = Template::where('slug','home-page')->first();
      }

      $menu = $template->menus->first();
      $body = $page->getBody();

      return view('templates.'.$template->slug, compact('page','template','menu','body'));
    }

    public function page($slug){
        $route = $slug;
        $routes = Route::getRoutes();
        foreach($routes as $r){
          if($r->uri() == $route){
            $name = $r->getActionName();
            if(isset($name)){
              return \App::call('\\'.$name);
            }
          }
        }

        $page 	 = Content::where('slug',$slug)->where('type_id', 1)->isPublished()->first();

        if(!isset($page))
        {
          abort(404);
        }

        if(isset($page->template->id)){
          $template = $page->template;
        }
        else {
          $template = $page->type->templates->sortByDesc('updated_at')->first();
        }

        $menu = $template->menus->first();
        $body = $page->getBody();

        return view('templates.'.$template->slug, compact('page','template','body','menu'));
    }
    public function pageByType($type,$slug){
        $route = $type.'/'.$slug;
        $routes = Route::getRoutes();
        foreach($routes as $r){
          if($r->uri() == $route){
            $name = $r->getActionName();
            if(isset($name)){
              return \App::call('\\'.$name);
            }
          }
        }

        if($type == 'page')
        {
          return redirect('/'.$slug, 301);
        }

        $type    = Type::where('slug',$type)->first();
        if(isset($type))
        {
          $page 	 = Content::where('slug',$slug)->where('type_id',$type->id)->isPublished()->with(['rows', 'components'])->first();
        }
        else
        {
          abort(404);
        }

        if(!isset($page)){
          abort(404);
        }
        if(isset($page->template->id)){
          $template= $page->template;
        }
        else {
          $template = $page->type->templates->sortByDesc('updated_at')->first();
        }

        $menu = $template->menus->first();
        $body = $page->getBody();

        return view('templates.'.$template->slug, compact('page','template', 'body', 'menu'));
    }
    public function preview($slug){

        $page 	 = Content::where('slug',$slug)->first();

        if(!isset($page)){
          abort(404);
        }
        $body = Html::where('content_id', $page->id)->where('published',1)->first();

        if(isset($page->template->id)){
          $template= $page->template;
        }
        else {
          $template = $page->type->templates->sortByDesc('updated_at')->first();
        }

        return view('templates.'.$template->slug, compact('page','template', 'body'));

    }

    public function form(Request $request, $id){

      $validate = Validator::make(Request::all(), [
      	'g-recaptcha-response' => 'required|captcha'
      ]);


        $form = Form::find($id);

        if(!isset($form)){
          return 'error - form is imaginary';
        }

        $submission = new Submission;
        $submission->form()->associate($form);
        $submission->save();

        foreach($form->questions as $question){
          if($question->type != 'section'){
            $answer = new Answer;
            $answer->content = $request->input('woodpecker'.$question->id);
            $answer->submission()->associate($submission);
            $answer->question()->associate($question);
            $answer->save();
          }
        }


        return redirect($form->redirect);


    }
    public function search(Request $request) {

  	  $search        = $request->input('search');
  	  if(isset($search)){
  	    $results       	= Content::where('title', 'like', '%'.$search.'%')->orWhere('keywords', 'like', '%'.$search.'%')->orWhere('metadesc', 'like', '%'.$search.'%')->isPublished()->orderBy('created_at','DESC')->get();
  	  }
      else
      {
        $results        = [];
      }
  		if(isset($results) && count($results)>0){
  			$success=true;
  		}
  		else {
  			$results        = Content::inRandomOrder()->take(6)->get();
        $success        = false;
  		}
      $template = Template::find(1);
      $menu = $template->menus->first();

  	  return view('templates.results', compact('results','success','template','menu'));
	  }

    public function loopContent($id){

        $page 	 = Content::find($id);
        if(!isset($page)){
          abort(404);
        }
        if(isset($page->template->id)){
          $template = $page->template;
        }
        else {
          $template = $page->type->templates->sortByDesc('updated_at')->first();
        }

        return view('dashboard.includes.content-loop', compact('page','template'));
    }

}
