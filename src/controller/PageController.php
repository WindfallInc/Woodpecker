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
use App\Template;
use App\Type;
use App\Content;
use App\Category;
use App\Row;
use App\Component;
use App\Menu;
use App\Nav;
use App\Event;
use App\Form;
use App\Question;
use App\Submission;
use App\Answer;
use App\Html;


use Auth;
use Illuminate\Support\Facades\Input;
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
    public function index()
    {
      $page 	 = Content::where('slug','home')->where('published', 1)->first();
      if(!isset($page)){
        abort(404);
      }
      if(isset($page->template)){
        $template = Template::where('slug',$page->template)->first();
      }
      else{
        $template = Template::where('slug','home-page')->first();
      }

      return view('templates.'.$template->slug, compact('page','template'));
    }

    public function home()
    {
      $page 	 = Content::where('slug','home')->where('published', 1)->first();
      if(!isset($page)){
        abort(404);
      }
      if(isset($page->template)){
        $template = Template::where('slug',$page->template)->first();
      }
      else{
        $template = Template::where('slug','home-page')->first();
      }

      return view('templates.'.$template->slug, compact('page','template'));
    }

    public function page($slug){
        $route = $slug;
        $routes = Route::getRoutes();
        foreach($routes as $r){
          if($r->uri() == $route){
            $name = $r->getActionName();
            //return $name;
            if(isset($name)){
              return \App::call('\\'.$name);
            }
          }
        }

        $page 	 = Content::where('slug',$slug)->where('published', 1)->first();

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


        return view('templates.'.$template->slug, compact('page','template','body'));
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

        $type    = Type::where('slug',$type)->first();
        if(isset($type))
        {
          $page 	 = Content::where('slug',$slug)->where('type_id',$type->id)->where('published', 1)->with(['rows', 'components'])->first();
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

        $body = Html::where('content_id', $page->id)->where('published',1)->first();

        return view('templates.'.$template->slug, compact('page','template', 'body'));
    }
    public function preview($slug){

        $page 	 = Content::where('slug',$slug)->first();

        if(!isset($page)){
          abort(404);
        }
        $body = Html::where('content_id', $page->id)->where('published',1)->first();

        $template = $page->type->templates->first();

        return view('templates.'.$template->slug, compact('page','template', 'body'));

    }

    public function form(Request $request, $id){

      $validate = Validator::make(Input::all(), [
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
            $answer->content = Input::get($question->slug);
            $answer->submission()->associate($submission);
            $answer->question()->associate($question);
            $answer->save();
          }
        }


        return redirect($form->redirect);


    }
    public function search() {

  	  $search        = Input::get('search');
  	  if(isset($search)){
  	    $results       	= Content::where('title', 'like', '%'.$search.'%')->orWhere('keywords', 'like', '%'.$search.'%')->orWhere('metadesc', 'like', '%'.$search.'%')->orderBy('created_at','DESC')->get();
  	  }
  	  else{
  	    $results        = Content::inRandomOrder()->take(6)->get();
  	  }
  		if(count($results)>0){
  			$success=true;
  		}
  		else {
  			$results        = Content::inRandomOrder()->take(6)->get();
        $success=false;
  		}
      $template = Template::find(1);

  	  return view('templates.results', compact('results','success','template'));
	  }

    public function loopContent($id){

        $page 	 = Content::find($id);

        if(!isset($page)){
          abort(404);
        }


        return view('dashboard.includes.content-loop', compact('page'));
    }





}
