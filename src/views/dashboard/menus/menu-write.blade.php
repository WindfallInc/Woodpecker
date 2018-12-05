@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/menu/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>New Menu</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Menu</h3></button>
      </div>
    </div>

    <div class="row">

      <div class="four columns">
        <p>Menu Title
        <input type="text" name="title" placeholder="Main nav, top nav, sidebar, etc..."></p>
        <p>&nbsp;</p>
        @foreach($templates as $template)
          <p>
          <input value="{{$template->id}}" name="templates[]" type="checkbox" class="tinycheck">{{$template->title}}</p>
        @endforeach
      </div>
      <div class="four push_two columns">


      </div>

    </div>


  </form>

  @push('footer')

  @endpush

@endsection
