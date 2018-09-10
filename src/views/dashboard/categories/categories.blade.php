@extends('layouts.dashboard')

@section('content')
    <div class="row no-gutter">
      <p></p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>Categories</h3>
      </div>
      <div class="two columns">
        <h3>Edited</h3>
      </div>
      <div class="six columns">
        <a href="/dashboard/category/create"><h3 class="create">New Category</h3></a>
      </div>
    </div>

    <div class="row dashboard-list">
      <hr>
      @if(count($categories)==0)
        <p>You have no categories. Try creating one! Categories are ways of organizing datatypes. You may want a category to specify which events are "in missoula" or a category to specify which pages are about "things to do". Categories help you organize your website in this way.</p>
      @endif
      @foreach($categories as $category)
      <div class="row">
        <div class="four columns">
          <p>{{$category->title}}</p>
        </div>
        <div class="four columns">
          <p>{{date('M j, Y',strtotime($category->updated_at))}}</p>
        </div>
        <div class="two columns">
          <a href="/dashboard/category/{{$category->slug}}/edit"><p class="edit">Edit</p></a>
        </div>
        <div class="two columns">
          <a href="/dashboard/category/{{$category->slug}}/delete"><p class="delete">Delete</p></a>
        </div>
      </div>
      <hr>
      @endforeach
    </div>

@endsection
