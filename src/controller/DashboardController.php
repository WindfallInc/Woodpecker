<?php

/*
* THIS FILE SHOULD NOT BE EDITED
* This file will be overwritten if the cms updates
* to make changes to this file, duplicate it
*/

namespace App\Http\Controllers;

use App\User;
use App\Woodpecker\Template;
use App\Woodpecker\Type;
use App\Woodpecker\Content;
use App\Woodpecker\Category;
use App\Woodpecker\Row;
use App\Woodpecker\Component;
use App\Woodpecker\Menu;
use App\Woodpecker\Nav;
use App\Woodpecker\Media;
use App\Woodpecker\Form;
use App\Woodpecker\Question;
use App\Woodpecker\Answer;
use App\Woodpecker\Submission;
use App\Woodpecker\CustomField;
use App\Woodpecker\CustomFieldContent;
use App\Woodpecker\Dashboard;
use App\Woodpecker\Permission;
use App\Woodpecker\Ticket;
use App\Woodpecker\Html;
use App\Woodpecker\Setting;
use Image;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Log;

class DashboardController extends Controller
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
     public function __construct()
    {
        $this->middleware('dashboard');
        $this->middleware(function ($request, $next) {
            $this->user            = Auth::guard('dashboard')->user();
            $this->types           = Type::all();
            $this->menus           = Menu::all();
            $this->categories      = Category::all();
            $this->components      = Component::all();
            $this->templates       = Template::all();
            $this->custom_items    = Setting::where('title','Custom Menu Item')->get();

            view()->share('user', $this->user);
            view()->share('types', $this->types);
            view()->share('menus', $this->menus);
            view()->share('categories', $this->categories);
            view()->share('components', $this->components);
            view()->share('templates', $this->templates);
            view()->share('custom_items', $this->custom_items);

            return $next($request);
        });

    }

    public function index()
    {

      	  $user = Auth::guard('dashboard')->user();

          $view = view('dashboard.dashboard');

          if($user->tutorial_1 == 0)
          {
            $user->tutorial_1 = 1;
            $user->save();
            $tutorial = true;
            $view = $view->with('tutorial', $tutorial);
          }

          return $view;
    }

    public function contents($type)
    {
          $contents = Content::where('type_id',$type)->orderByDesc('updated_at')->get();
          $type = Type::find($type);

          return view('dashboard.all.component-call',compact('contents','type'));
    }

    public function deleted($type)
    {
          $contents = Content::where('type_id',$type)->whereNotNull('deleted_at')->orderByDesc('updated_at')->withTrashed()->get();
          $type = Type::find($type);
          $deleted = true;
          return view('dashboard.all.component-call',compact('contents','type','deleted'));
    }

    public function contentCreate($type)
    {
          $type = Type::find($type);
          $last = Row::orderBy('id', 'DESC')->first();
          if(isset($last)){
            $last = $last->id;
            $last++;
          }
          else{
            $last = 1;
          }

          $lastComponent = Component::orderBy('id', 'DESC')->first();
          if(isset($lastComponent)){
            $lastComponent = $lastComponent->id;
            $lastComponent++;
          }
          else {
            $lastComponent = 1;
          }

          $lastImage = Media::orderBy('id', 'DESC')->first();
          if(isset($lastImage)){
            $lastImage = $lastImage->id;
          }
          else {
            $lastImage = 1;
          }

          return view('dashboard.content.content-write', compact('type','last','lastComponent','lastImage'));
    }

    public function contentStore(Request $request, $type, $id, $draft = false)
    {

      if($id=='draft')
      {
        $draft = true;
      }
      else {
        $content = Content::find($id);
      }

      if($draft!= false)
      {
        $draft = true;
      }

      $user = Auth::guard('dashboard')->user();

      if(isset($content)){
        if(!$user->canEdit($content->id)){
          abort(403);
        }

        foreach($content->rows as $row){
          $row->content()->dissociate();
          $row->save();
        }

        foreach($content->components as $component){
          $component->content()->dissociate();
          $component->save();
        }

        $content->categories()->detach();
      }
      else {
        $content           = New Content;
      }
      $content->type_id                     = $type;
      $content->title                       = ucwords($request->input('title'));
      $content->keywords                    = $request->input('keywords');
      $content->metadesc                    = $request->input('metadesc');
      $content->slug                        = str_slug($request->input('title'),"-");
      $content->start_date                  = strtotime($request->input('start_date'));
      $content->end_date                    = strtotime($request->input('end_date'));
      $template                             = Template::find($request->input('template'));
      if(isset($template)){
        $content->template()->associate($template);
      }

      $content->save();

      foreach($content->type->custom_fields as $custom){
        $field = $content->customFieldContent->where('custom_field_id',$custom->id)->first();
        if(isset($field)){
          $field->content                  = $request->input('customfield'.$custom->id);
        } else {
          $field                           = new CustomFieldContent;
          $field->content                  = $request->input('customfield'.$custom->id);
          $field->content()->associate($content);
          $field->customField()->associate($custom);
        }
        $field->save();
      }


      $cats = $request->input('categories');
      if(isset($cats)){
        foreach($request->input('categories') as $cat){
          $category = Category::where('slug',$cat)->first();
          $content->categories()->attach($category);
        }
      }

      if($request->hasFile('featimage'))
      {

        $feat = $content->media()->where('featured', 1)->first();
        if(isset($feat)){
          $feat->featured = 0;
          $feat->save();
          $content->media($feat)->detach();
        }
        $ext                = $request->file('featimage')->extension();
        if($ext == 'pdf'){
          return 'a featured image cannot be in pdf format.';
        }
        $load               = $request->file('featimage');
        $now = date('Mdi');

        // Save full image
        $img = Image::make($load)->encode('jpg', 55);
        if($img->filesize() > 3000000){
          $img->resize(800,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();});
        }
        elseif($img->filesize() > 2000000){
          $img->resize(1300,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();});
        }
        elseif($img->filesize() > 1300000){
          $img->resize(1800,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();});
        }
        else{
          $img->resize(2200,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();});
        }

        $img->save('featured/'.$content->slug.$now.'.'.$ext);
        // Save thumbnail
        $img = Image::make($load)->resize(300,null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();})->encode('jpg',55)->save('featured/'.$content->slug.$now.'-thumbnail.'.$ext);

        $media                 = new Media;
        $media->slug           = $content->slug.'-featured';
        $media->featured       = 1;
        $media->path           = '/featured/'.$content->slug.$now.'.'.$ext;
        $media->thumbnail      = '/featured/'.$content->slug.$now.'-thumbnail.'.$ext;

        $media->save();
        if(isset($content->category)){
          foreach($content->category as $cat){
            $media->category()->attach($cat);
          }
        }
        $media->contents()->attach($content);
        $content->featimg = 1;
        $featimagesaved=true;
      }
      $content->save();

      $imagecount = 0;
      if($request->hasFile('additionalimages'))
      {
      foreach($request->file('additionalimages') as $image){
        $imagecount++;
        $additional               = $image;
        $ext                      = $image->extension();
        if($ext == 'pdf'){
          Storage::disk('docs')->putFileAs('uploaded-'.date("Y"), $additional,$content->slug.$imagecount.date('Mdi').'.'.$ext);
          $media                  = new Media;
          $media->slug            = $content->slug.$imagecount;
          $media->path            = '/docs/'.$media->slug.date('Mdi').'.'.$ext;
        }
        else{
          $img = Image::make($additional)->resize(2200,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();})->save('additional/'.$content->slug.$imagecount.date('Mdi').'.'.$ext);
          $img = Image::make($additional)->resize(300,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();})->save('additional/'.$content->slug.$imagecount.date('Mdi').'-thumbnail.'.$ext);

          $media                  = new Media;
          $media->slug            = $content->slug.$imagecount;
          $media->path            = '/additional/'.$content->slug.$imagecount.date('Mdi').'.'.$ext;
          $media->thumbnail       = '/additional/'.$content->slug.$imagecount.date('Mdi').'-thumbnail.'.$ext;
        }

          $media->save();
          $media->contents()->attach($content);
          if(isset($content->category)){
            foreach($content->category as $cat){
              $media->category()->attach($cat);
            }
          }

      }
      }



      $texts             = $request->input('column');
      $count             = 0;
      $ids               = 0;
      $hasrows           = $request->input('columns');

      if(isset($hasrows)){
      foreach($request->input('columns') as $thing){

        $columns = array_slice($texts, $count, $thing);
        $id = array_slice($request->input('row'), $ids);
        $ids++;
        $count = $count + $thing;
        if($thing == 1){
          $text = '<div class="twelve columns">' . $columns[0] . '</div>';
        }
        elseif($thing == 2){
          $text = '<div class="six columns">' . $columns[0] . '</div>' . '<div class="six columns">' . $columns[1] . '</div>';
        }
        elseif($thing == 3){
          $text = '<div class="four columns">' . $columns[0] . '</div>' . '<div class="four columns">' . $columns[1] . '</div>'. '<div class="four columns">' . $columns[2] . '</div>';
        }
        elseif($thing == 4){
          $text = '<div class="three columns">' . $columns[0] . '</div>' . '<div class="three columns">' . $columns[1] . '</div>'. '<div class="three columns">' . $columns[2] . '</div>'. '<div class="three columns">' . $columns[3] . '</div>';
        }
        elseif($thing == 5){
          $text = '<div class="two columns">' . $columns[0] . '</div>' . '<div class="two columns">' . $columns[1] . '</div>'. '<div class="two columns">' . $columns[2] . '</div>'. '<div class="two columns">' . $columns[3] . '</div>'. '<div class="two columns">' . $columns[4] . '</div>';
        }

        $oldrow           = Row::find((int)$id[0]);
        if(isset($oldrow))
        {
          $row = $oldrow;
        }
        else{
          $row = New Row;
          $row->id = (int)$id[0];
        }


        $imgtag = preg_match_all('/<img[^>\n]*src="data:[^>\n]*+\>/', $text, $m);
        foreach($m[0] as $ma){
          $datasrc = preg_match_all('/data-id="(.*?)"/', $ma, $matches);
          foreach($matches[1] as $val)
          {
            if(isset($featimagesaved)){
              $val++;
            }
            $media = Media::find($val++);
            $src   = $media->path;
            $text = str_replace('src="data:placeholder"', 'src="'.$src.'"', $text);
              //replace src with src in match
          }
        }
        $row->content = $text;
        $row->columns = $thing;
        $row->content()->associate($content);
        $row->save();

      }
    } else {

    }


      // Save components
      $count                          = 0;
      $count1                         = 0;
      $count2                         = 0;
      $count3                         = 0;
      $count4                         = 0;
      $count5                         = 0;
      $count6                         = 0;
      $imgcount                       = 0;
      $input1                         = $request->input('input1');
      $input2                         = $request->input('input2');
      $input3                         = $request->input('input3');
      $input4                         = $request->input('input4');
      $input5                         = $request->input('input5');
      $input6                         = $request->input('input6');
      $components                     = $request->input('component-slug');
      if(isset($components)){
      foreach($components as $slug){
        $id                           = array_slice($request->input('component-id'), $count);
        $old                          = Component::find($id[0]);

        if(isset($old)){
          $component                  =  $old;
        }
        else {
          $component                  = new Component;
          $component->id              = $id[0];
        }

        $component->title             = $content->title .' '. $slug;
        $component->slug              = $slug;
        $father                       = Component::where('slug', $slug)->first();
        $component->parent_id         = $father->id;
        $component->columns           = $father->columns;
        $component->link_target       = $father->link_target;
        $component->category_selection     = $father->category_selection;
        $component->type_selection    = $father->type_selection;
        $component->reqimg            = $father->reqimg;

        if(isset($input1)){
          if(isset($component->parent->content1)){
            $thing                    = array_slice($input1, $count1);
            $component->content1      = $thing[0];
            $count1++;
          }
        }
        if(isset($input2)){
          if(isset($component->parent->content2)){
            $thing                        = array_slice($input2, $count2);
            $component->content2          = $thing[0];
            $count2++;
          }
        }
        if(isset($input3)){
          if(isset($component->parent->content3)){
            $thing                        = array_slice($input3, $count3);
            $component->content3          = $thing[0];
            $count3++;
          }
        }
        if(isset($input4)){
          if(isset($component->parent->content4)){
            $thing                        = array_slice($input4, $count4);
            $component->content4          = $thing[0];
            $count4++;
          }
        }
        if(isset($input5)){
          if(isset($component->parent->content5)){
            $thing                        = array_slice($input5, $count5);
            $component->content5          = $thing[0];
            $count5++;
          }
        }
        if(isset($input6)){
          if(isset($component->parent->content6)){
            $thing                        = array_slice($input6, $count6);
            $component->content6          = $thing[0];
            $count6++;
          }
        }


        if(isset($component->link_target)){
          $component->outside  = $request->input('link_target'.$component->id);
          if(!isset($component->outside)){$component->outside = 'off';}
        }
        if(isset($component->category_selection)){
          $component->category_id  = $request->input('catid'.$component->id);
        }
        if(isset($component->type_selection)){
          $component->type_id  = $request->input('typeid'.$component->id);
        }

        $image                      = $request->file('component'.$component->id.'-img');

        if(isset($component->reqimg) && isset($image)){
            $load                         = $image;
            $imgcount++;

            if($load->extension())
            {
              $ext                        = $load->extension();
              if($ext == 'pdf'){
                return 'a component image cannot be in pdf format.';
              }

              $img = Image::make($load)->resize(800,null, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();})->save('component/'.$component->slug.'-'.$content->slug.$component->id.date('Mdi').'.'.$ext);

              $media                     = new Media;
              $media->slug               = $component->slug.'-'.$content->slug;
              $media->featured           = 0;
              $media->path               = '/component/'.$component->slug.'-'.$content->slug.$component->id.date('Mdi').'.'.$ext;

              $media->save();
              if(isset($content->category)){
                foreach($content->category as $cat){
                  $media->category()->attach($cat);
                }
              }
              $component->image = $media->path;
            }

        }


        $component->content()->associate($content);
        $component->save();
        if($component->slug == 'carousal'){
          $imagecount = 0;
          if($request->hasFile('carousalimages'))
          {
            foreach($request->file('carousalimages') as $image){
              $imagecount++;
              $additional               = $image;
              $ext                      = $image->extension();
              if($ext == 'pdf'){
                continue;
              }
              else{
                $img = Image::make($additional)->resize(2200,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})->save('carousal/'.$content->slug.$imagecount.date('Mdi').'.'.$ext);
                $img = Image::make($additional)->resize(800,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();})->save('carousal/'.$content->slug.$imagecount.date('Mdi').'-thumbnail.'.$ext);

                $media                  = new Media;
                $media->slug            = $content->slug.$imagecount;
                $media->path            = '/carousal/'.$content->slug.$imagecount.date('Mdi').'.'.$ext;
                $media->thumbnail       = '/carousal/'.$content->slug.$imagecount.date('Mdi').'-thumbnail.'.$ext;
              }

                $media->component()->associate($component);
                $media->save();


            }
          }
        }
        if($component->slug == 'questionair'){
          $formId   = $request->input('formid'.$component->id);
          if(!isset($formId)){
            $formId   = $request->input('formid');
          }
          $form     = Form::find($formId);
          $component->form()->associate($form);
          $component->save();
          // do not create a snapshot of any page with a Form
          $dynamic = true;
        }
        if($component->dynamic == 1)
        {
          $dynamic = true;
        }
        $count++;

      } // end foreach components

      }



      $order = $request->input('order');
      $orders = explode(",", $order );
      $count = 1;
      foreach($orders as $order){
        $row = Row::where('id', $order)->where('content_id', $content->id)->first();
        $component = Component::where('id', $order)->where('content_id', $content->id)->first();
        if(isset($skip) && $skip==1){
          $skip=0;
          continue;
        }
        if(isset($component->id) && isset($row->id))
        {
          $row->order = $count;
          $row->save();

          $count++;

          $lastComponent = Component::orderBy('id', 'DESC')->first();
          $lastComponent = $lastComponent->id;
          $lastComponent++;
          $component->id = $lastComponent;
          $component->order = $count;
          $component->save();
          $count++;

          $skip = 1;
        }
        elseif(isset($row)){
          $row->order = $count;
          $row->save();
          $count++;
        }
        elseif(isset($component)){
          $component->order = $count;
          $component->save();
          $count++;
        }
      }

      /*
      * If all goes well, save the html snapshot of the page.
      * This will increase load times, and provide redundent
      * copies of the code as failsafe.
      */
      if(!isset($dynamic))
      {
        $url = url('/get/loop/'. $content->id);
        $code     = file_get_contents($url);
        $snapshot = Html::where('content_id',$content->id)->where('published',1)->first();
        if(isset($snapshot)){
          $snapshot->published = 0;
          $snapshot->save();
        }
        $html = new Html;
        $html->published = 1;
        $html->code = $code;
        $html->content()->associate($content);
        $html->save();
      }
      else
      {
        $snapshots = Html::where('content_id',$content->id)->where('published',1)->get();
        foreach($snapshots as $snapshot)
        {
          $snapshot->published = 0;
          $snapshot->save();
        }
      }

      if(isset($fail)){
        return redirect('dashboard/'.$type.'/create')->withInput();
      }


      if($draft){
        $content->published = 0;
        $content->save();
        return redirect()->route('preview', ['slug'=>$content->slug]);
      }
      else{
        $content->published = 1;
        $content->save();
        return redirect()->route('contents', ['type'=>$type]);
      }
    }

    public function contentUpdate(Request $request)
    {
      $post_id = $request['postId'];
      $content = Content::find($post_id);
      if($content->published ==1){
        $content->published = 0;
      }
      else{
        $content->published = 1;
      }

      $content->save();

      return 'true';


    }

    public function contentEdit($type,$id)
    {
      $type = Type::find($type);
      $content = Content::withTrashed()->where('id', $id)->first();
      $last = Row::orderBy('id', 'DESC')->first();
      $last = $last->id;
      $last++;
      $lastComponent = Component::orderBy('id', 'DESC')->first();
      $lastComponent = $lastComponent->id;
      $lastComponent++;
      $lastImage = Media::orderBy('id', 'DESC')->first();
      $lastImage = $lastImage->id;
      return view('dashboard.content.content-edit',compact('type','content','last','lastComponent','lastImage'));
    }

    public function contentDelete(Request $request, $type)
    {
          $post_id = $request['postId'];
          $delete = Content::find($post_id);
          $media = $delete->media;
          foreach($media as $img)
          {
            $img->delete();
          }
          $delete->delete();

          return 'true';
    }


    public function types()
    {
          $contents   = Type::all();
          $type = new Type;
          $type->title = 'Type';
          $type->slug = 'type';
          $type->id = 0;
          return view('dashboard.all.component-call', compact('contents','type'));
    }

    public function typeCreate()
    {
          $templates = Template::all();
          $lastcustom = CustomField::orderBy('id', 'DESC')->first();
          if(!isset($lastcustom))
          {
            $lastcustom = 1;
          }
          $lastcustom = $lastcustom->id;
          return view('dashboard.types.type-write', compact('templates','lastcustom'));
    }

    public function typeStore(Request $request)
    {
      if(Type::where('slug', $request->input('slug'))->first()){
        $type           = Type::where('slug', $request->input('slug'))->first();
        $user = Auth::guard('dashboard')->user();
        if(!$user->canEdit($type->id)){
          abort(403);
        }
        $type->templates()->detach();
      }
      else {
        $type             = New Type;
      }

        $type->title      = $request->input('title');
        $type->slug       = str_slug($request->input('title'),"-");
        $type->categories = $request->input('categories');
        $type->editor     = $request->input('editor');
        $type->time     = $request->input('time');
        $slug             = $request->input('template');
        $template         = Template::where('slug',$slug)->first();
        $type->save();
        $type->templates()->attach($template);


        $custom_field = $request->input('custom_field');
        $custom_type = $request->input('custom_type');
        $custom_id = $request->input('custom_id');
        $count = 0;


        if(isset($custom_id)){
          $type->custom_fields()->detach();
          foreach($request->input('custom_id') as $custom_id){
            $custom = CustomField::find($custom_id);
            if(!isset($custom)){
              $custom = new CustomField;
            }

            $input = array_slice($request->input('custom_field'), $count);
            $custom->name = $input[0];
            $input = array_slice($request->input('custom_type'), $count);
            $custom->input = $input[0];
            $custom->save();
            $type->custom_fields()->attach($custom);
            $count++;
          }
        }



      if(isset($fail)){
        return Redirect::to('dashboard/new/create')->withInput();
      }

      return redirect()->route('contents', ['type'=>$type]);
    }

    public function typeEdit($id)
    {
          $type = Type::find($id);
          $templates = Template::all();
          $lastcustom = CustomField::orderBy('id', 'DESC')->first();
          if(isset($lastcustom)){
            $newid = $lastcustom->id;
            $newid = $newid++;
          }
          else {
            $newid = 1;
          }
          $lastcustom = $newid;

          return view('dashboard.types.type-edit',compact('type','templates','lastcustom'));
    }

    public function typeDelete($id)
    {
          $type    = Type::find($id);
          $type->delete();

          return redirect()->route('types');
    }

    public function typeCustomDelete(Request $request, $custom)
    {
          $custom_id = $request['postId'];
          $delete = CustomField::find($custom_id);
          $delete->delete();

          return 'true';
    }


    public function menus()
    {
          $contents   = Menu::all();
          $type = new Type;
          $type->title = 'Menu';
          $type->slug = 'menu';
          $type->id = 0;
          return view('dashboard.all.component-call', compact('contents','type'));
    }

    public function menuCreate()
    {
          $templates = Template::all();
          return view('dashboard.menus.menu-write',compact('templates'));
    }

    public function menuStore(Request $request)
    {
      $user = Auth::guard('dashboard')->user();
      if(!$user->canEditMenus()){
        abort(403);
      }
      if(Menu::where('slug', $request->input('slug'))->first()){
        $menu           = Menu::where('slug', $request->input('slug'))->first();
        $menu->templates()->detach();
      }
      else {
        $menu           = New Menu;
      }

        $menu->title    = $request->input('title');
        $menu->slug     = str_slug($request->input('title'),"-");
        $menu->save();
        $templates = $request->input('templates');
        if(isset($templates))
        {
          foreach($request->input('templates') as $template){
            $menu->templates()->attach($template);
          }
        }



      return redirect()->route('menu-details', ['id'=>$menu->id]);
    }

    public function menuEdit($id)
    {
          $menu = Menu::find($id);
          $templates = Template::all();

          return view('dashboard.menus.menu-edit',compact('menu','templates'));
    }

    public function menuDelete($id)
    {
          $delete    = Menu::find($id);
          $delete->delete();

          return redirect()->route('menus');
    }

    public function menuDetails($id)
    {
          $menu = Menu::find($id);
          $latest = Nav::orderBy('id', 'DESC')->first();
          if(isset($latest)){
            $newid = $latest->id;
            $newid = ++$newid;
          }
          else {
            $newid = 1;
          }

          return view('dashboard.menus.menu-detail', compact('menu','newid'));
    }
    public function menuUpdate(Request $request, $id)
    {
      $menu = Menu::find($id);
      foreach($menu->navs as $nav){
        $nav->delete();
      }

          $things = $request->input('out');
          if(isset($things)>0){
            foreach($things as $nav){
              $navi                                   = new Nav;
              $navi->title                            = $nav['title'];
              $navi->slug                             = str_slug($navi->title,"-");
              $navi->url                              = $nav['url'];
              $navi->target                           = $nav['target'];
              $navi->parent_id                        = NULL;
              $navi->menu()->associate($menu);
              $navi->save();
              if(isset($nav['children'])>0){
                foreach($nav['children'] as $child){
                  $navig                                   = new Nav;
                  $navig->title                            = $child['title'];
                  $navig->slug                             = str_slug($navig->title,"-");
                  $navig->url                              = $child['url'];
                  $navig->target                           = $child['target'];
                  $navig->parent_id                        = $navi->id;
                  $navig->menu()->associate($menu);
                  $navig->save();
                  if(isset($child['children'])>0){
                      foreach($child['children'] as $subchild){
                        $naviga                                   = new Nav;
                        $naviga->title                            = $subchild['title'];
                        $naviga->slug                             = str_slug($naviga->title,"-");
                        $naviga->url                              = $subchild['url'];
                        $naviga->target                           = $subchild['target'];
                        $naviga->parent_id                        = $navig->id;
                        $naviga->menu()->associate($menu);
                        $naviga->save();
                      }
                  }
                }
              }
            }
          }

            return 'yay!';

    }



    public function components()
    {
          $components   = Component::all();
          return view('dashboard.components', compact('components'));
    }

    public function componentCreate()
    {

          return view('dashboard.component-write');
    }

    public function componentStore(Request $request)
    {

      $component           = New Component;
      $component->update($request->all());
      Input::flash();
      $component->save();

      if($fail){
        return Redirect::to('dashboard/new/create')->withInput();
      }

      return redirect()->route('dashboard/components');
    }

    public function componentEdit($slug)
    {
          $component = Component::where('slug',$slug)->get();

          return view('dashboard.component-edit',compact('component'));
    }

    public function componentDelete($slug)
    {
          $delete    = Component::where('slug',$slug)->first();
          $delete->delete();

          return redirect()->route('components');
    }


    public function categories()
    {
          $contents   = Category::all();
          $type = new Type;
          $type->title = 'Category';
          $type->slug = 'category';
          $type->id = 0;
          return view('dashboard.all.component-call', compact('contents','type'));
    }

    public function categoryCreate()
    {

          return view('dashboard.categories.category-write');
    }

    public function categoryStore(Request $request)
    {
      if(Category::where('slug', $request->input('slug'))->first()){
        $category           = Category::where('slug', $request->input('slug'))->first();
      }
      else {
        $category           = New Category;
      }

      $category->title    = ucwords($request->input('title'));
      $category->slug     = str_slug($request->input('title'),"-");
      $category->save();

      return redirect()->route('categories');
    }

    public function categoryEdit($id)
    {
          $category = Category::find($id);

          return view('dashboard.categories.category-edit',compact('category'));
    }

    public function categoryDelete($id)
    {
          $delete    = Category::find($id);
          $delete->delete();

          return redirect()->route('categories');
    }


    public function media()
    {
          $files   = Media::where('extension','.pdf')->get();

          $feats   = Media::where('featured', 1)->get();

          $images  = Media::where('featured', 0)->whereNull('extension')->get();

          return view('dashboard.media.media', compact('files','images','feats'));
    }

    public function mediaCreate()
    {

          return view('dashboard.media.media-write');
    }

    public function mediaStore(Request $request)
    {


      $media               = new Media;
      $media->slug         = str_slug($request->input('title'),"-");
      $media->featured     = 0;


      if($request->hasFile('image'))
      {
        $load                = $request->file('image');
        $ext                 = $request->file('image')->extension();
        if($ext == 'pdf'){
          Storage::disk('docs')->putFileAs('uploaded-'.date("Y"), $load,$media->slug.'.'.$ext);
          $media->path = '/docs/'.'uploaded-'.date("Y").'/'.$media->slug.'.'.$ext;
          $media->extension = '.pdf';
        }
        else{
          $img = Image::make($load)->resize(2500,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();})->save('additional/'.$media->slug.'.'.$ext);
          $img = Image::make($load)->resize(300,null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();})->save('additional/'.$media->slug.'-thumbnail.'.$ext);


          $media->path = '/additional/'.$media->slug.'.'.$ext;
          $media->thumbnail = '/additional/'.$media->slug.'-thumbnail.'.$ext;
        }
        $media->save();
      }
      else {
        return redirect()->back()->with('error', 'Error: No file detected!');
      }


      $cats = $request->input('categories');
      if(isset($cats)){
        foreach($request->input('categories') as $cat){
          $category = Category::where('slug',$cat)->first();
          $media->category()->attach($category);
        }
      }
      return redirect()->route('media');
    }

    public function mediaDelete(Request $request)
    {
          $media_id   = $request['mediaId'];
          $delete     = Media::find($media_id);
          $delete->delete();

          return 'true';
    }

    public function users()
    {
          $dashboards = Dashboard::all();
          return view('dashboard.users.users',compact('dashboards'));
    }
    public function userEdit($id)
    {
          $dashboard = Dashboard::find($id);

          $user = Auth::guard('dashboard')->user();

          $contents = Content::all();
          $types = Type::all();

          if($user->isAdmin())
          {
            return view('dashboard.users.user-edit',compact('dashboard','contents','types'));
          }
          else
          {
            abort(403);
          }
    }
    public function userUpdate(Request $request, $id)
    {
          $dashboard = Dashboard::find($id);
          $user = Auth::guard('dashboard')->user();

          if($user->isAdmin())
          {
            $dashboard->name = $request->input('name');
            $dashboard->email = $request->input('email');
            $admin = $request->input('admin');
            if($admin)
            {
              $dashboard->admin = $admin;
            }
            else
            {
              $dashboard->admin = 0;
            }
            $forms = $request->input('forms');
            if($forms)
            {
              $dashboard->forms = $forms;
            }
            else
            {
              $dashboard->forms = 0;
            }
            $menus = $request->input('menus');
            if($menus)
            {
              $dashboard->menus = $menus;
            }
            else
            {
              $dashboard->menus = 0;
            }
            $confirmed = $request->input('confirmed');
            if($confirmed)
            {
              $dashboard->confirmed = $confirmed;
            }
            else
            {
              $dashboard->confirmed = 0;
            }
            $dashboard->save();
            foreach($dashboard->permissions as $p)
            {
              $p->delete();
            }
            $typep = $request->input('typepermissions');
            if(isset($typep))
            {
              foreach($request->input('typepermissions') as $permission)
              {
                $type = Type::find($permission);
                $dashboardPermission = new Permission;
                $dashboardPermission->type()->associate($type);
                $dashboardPermission->user()->associate($dashboard);
                $dashboardPermission->save();
              }
            }
          }
          else
          {
            abort(403);
          }
          return redirect()->route('users');
    }
    public function userDelete($id)
    {
          $dashboard = Dashboard::find($id);
          $dashboard->delete();

          return redirect()->route('users');
    }

    public function forms()
    {
          $forms = Form::all();
          return view('dashboard.forms.forms',compact('forms'));
    }
    public function formCreate()
    {
          return view('dashboard.forms.form-write');
    }
    public function formStore(Request $request)
    {
          $user = Auth::guard('dashboard')->user();
          if(!$user->canEditForms()){
            abort(403);
          }
          $old                 = Form::where('slug', $request->input('slug'))->first();
          if(isset($old)){
            $form              = Form::where('slug', $request->input('slug'))->first();
          }
          else {
            $form              = new Form;
          }
          $form->title         = $request->input('title');
          $form->slug          = str_slug($request->input('title'),"-");
          $form->cta           = $request->input('cta');
          $form->redirect      = $request->input('redirect');
          $form->notifications = $request->input('notifications');
          $form->save();

          return redirect()->route('formDetails', ['id'=>$form->id]);
    }
    public function formEdit($id)
    {
          $form           = Form::find($id);
          return view('dashboard.forms.form-edit',compact('form'));
    }
    public function formDetails($id)
    {
          $form = Form::find($id);

          $lastQuestion = Question::orderBy('id', 'DESC')->first();
          if(isset($lastQuestion)){
            $lastQuestion = $lastQuestion->id;
          }
          else {
            $lastQuestion = 1;
          }
          return view('dashboard.forms.form-detail',compact('form','lastQuestion'));
    }
    public function formUpdate(Request $request, $id)
    {
          $user = Auth::guard('dashboard')->user();
          if(!$user->canEditForms()){
            abort(403);
          }
          $form  = Form::find($id);
          $order = $request->input('order');
          $orders = explode(",", $order );
          $counter = 0;
          if(isset($form->questions))
          {
            foreach($form->questions as $q){
              $q->form()->dissociate($form);
              $q->save();
            }
          }



          foreach($orders as $q){
            $question      = Question::find($q);
            if(!isset($question)){
              $question    = new Question;
            }
            $counter++;

            $question->id         = $q;
            $question->type       = $request->input('type'.$q);
            $question->required       = $request->input('required'.$q);
            $question->title      = $request->input('title'.$q);
            if($question->type == 'section'){
              $question->slug       = $question->id . '-section';
            } else {
              $question->slug       = str_slug($question->title,"-");
            }

            $question->columns    = $request->input('columns'.$q);
            switch($question->columns) {
              case 'twelve':
                $column = 12;
                break;
              case 'six':
                $column = 6;
                break;
              case 'four':
                $column = 4;
                break;
              case 'three':
                $column = 3;
                break;
            }
            $question->columnInt  = $column;
            $question->order      = $counter;

            $question->form()->associate($form);
            $question->save();



            if($question->type == 'radio' || $question->type == 'select' || $question->type == 'checkbox-group'){
              // reset radio options
              foreach($question->children() as $kid){
                $kid->parent_id = NULL;
                $kid->save();
              }
              $children = $request->input('child'.$question->id);
              $count = 0;
              // save new radio options
              foreach($children as $child){
                $id                     = array_slice($request->input('childid'.$question->id), $count);
                $kid                      = Question::find($id[0]);
                if(!isset($kid)){
                  $kid                    = new Question;
                }
                $kid->id                  = $id[0];
                $kid->title               = $child;
                $kid->slug                = str_slug($child,"-");
                if($question->type == 'select'){
                  $kid->type                = 'select';
                }
                elseif($question->type == 'radio'){
                  $kid->type                = 'radio';
                  $columns                = array_slice($request->input('childcolumns'.$question->id), $count);
                  $kid->columns             = $columns[0];
                }
                elseif($question->type == 'checkbox-group'){
                  $kid->type                = 'checkbox';
                }


                $kid->parent()->associate($question);
                $kid->save();

                $count++;
              }
            }
          }
          return redirect()->route('forms');
    }
    public function formDelete($id)
    {
          $form = Form::find($id);
          $form->delete();

          return redirect()->route('forms');
    }
    public function formSubmissions($id)
    {
          $form          = Form::find($id);
          $questions     = $form->questions;
          $submissions   = $form->submissions;

          return view('dashboard.forms.form-submissions',compact('form','questions','submissions'));
    }
    public function submissionDelete(Request $request)
    {
          $submission_id = $request['postId'];
          $delete = Submission::find($submission_id);
          $delete->delete();

          return 'true';
    }
    public function submissionMassDelete($form)
    {
          $form = Form::find($form);
          foreach($form->submissions as $submission)
          {
            $submission->delete();
          }

          return redirect()->route('submissions', ['slug'=>$form->slug]);
    }
    public function export($id)
    {
          $form          = Form::find($id);
          $questions     = $form->questions;
          $submissions   = $form->submissions;
          $filename      = $form->title.'-export.csv';

          $headers = array(
              'Content-Type' => 'text/csv',
              "Content-Disposition" => "attachment; filename=file.csv",
              "Pragma" => "no-cache",
              "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
              "Expires" => "0"
          );

          $columns = array();
          foreach($questions as $question){
            $columns[] = $question->title;
          }

          $callback = function() use ($submissions, $columns)
          {
              $file = fopen('php://output', 'w');
              fputcsv($file, $columns);
              $rows    = array();

              foreach($submissions as $submission) {
                foreach($submission->answers as $answer){
                  $rows[] = $answer->content;
                }
                fputcsv($file, $rows);
                $rows    = array();
              }
              fclose($file);
              return $file;
          };
          return response()->streamDownload($callback, $filename, $headers);
    }

    public function settings()
    {
          $contents   = Setting::all();
          $type = new Setting;
          $type->title = 'Setting';
          $type->slug = 'setting';
          $type->id = 0;
          return view('dashboard.all.component-call', compact('contents','type'));
    }

    public function settingCreate()
    {

          return view('dashboard.settings.setting-write');
    }

    public function settingStore(Request $request)
    {
      if(Setting::where('title', $request->input('title'))->first()){
        $setting           = Setting::where('title', $request->input('title'))->first();
      }
      else {
        $setting           = New Setting;
      }

      $setting->title       = ucwords($request->input('title'));
      $setting->content    = $request->input('content');
      $setting->content2    = $request->input('content2');
      $setting->content3    = $request->input('content3');
      $setting->save();

      return redirect()->route('settings');
    }

    public function settingEdit($id)
    {
          $setting = Setting::find($id);

          return view('dashboard.settings.setting-edit',compact('setting'));
    }

    public function settingDelete($id)
    {
          $delete    = Setting::find($id);
          $delete->delete();

          return redirect()->route('settings');
    }



    public function serviceHelp()
    {
          return view('dashboard.help');
    }

    public function serviceSubmit(Request $request)
    {
      $sender 								= $request->input('name');
      $senderEmail 						= $request->input('email');
      $subject 								= "Jaunt CMS Service Ticket";
      $problem 								= $request->input('problem');

      $service = New Ticket;
      $service->name = $sender;
      $service->return_email = $senderEmail;
      $service->problem = $problem;
      $service->save();

      $recipient 							= 'andrew@windfallstudio.com';

      $mailBody="Client: $sender\nContact Email: $senderEmail \n problem: $problem \n";

      mail($recipient, $subject, $mailBody, "From: Jaunt CMS");


          return view('dashboard.dashboard');
    }
    public function serviceFaq()
    {
          return view('dashboard.faq');
    }



}