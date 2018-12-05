@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/category/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>{{$category->title}}</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Category</h3></button>
      </div>
    </div>

    <div class="row">
      <hr>

      <div class="four columns">
        <p>Category Title
        <input type="text" name="title" value="{{$category->title}}"></p>
        <p>Datatype slug
        <input type="text" name="slug" readonly value="{{$category->slug}}"></p>
        <p class="mini">Note that all slugs update automatically with their corresponding titles</p>
      </div>
      <div class="four push_two columns">
        <div class="textarea" contenteditable="true"></div>

      </div>

    </div>
    <div class="row">
      <h2>Belongs to the category:</h2>
      <ul>
      @if(count($category->contents)>1)
        @foreach($category->contents as $content)
          <li>{{$content->title}}</li>
        @endforeach
      @endif
      </ul>
    </div>


  </form>

  @push('footer')

  @endpush

@endsection
