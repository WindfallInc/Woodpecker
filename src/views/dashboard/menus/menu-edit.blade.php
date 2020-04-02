@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/menu/store" method="POST">
    {{ csrf_field() }}


    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">{{$menu->title}}</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <div class="ten columns">

        </div>
        <div class="two columns store">
          <i class="fa fa-sign-in"></i>
        </div>
      </div>
      <div class="dashboard-list">
        <div class="editor_zone" id="editor_zone">
          <div class="row box">
            <div class="four push_one columns">
              <p>Menu Title
              <input type="text" name="title" value="{{$menu->title}}"></p>
              <p>Menu slug
              <input type="text" readonly name="slug" value="{{$menu->slug}}"></p>
              <p class="mini">Note that all slugs update automatically with their corresponding titles</p>
              <p>&nbsp;</p>
              @foreach($templates as $template)
                <p>
                <input value="{{$template->id}}" name="templates[]" type="checkbox" @if($menu->templates->where('id', $template->id)->first()) checked @endif class="tinycheck">{{$template->title}}</p>
              @endforeach
            </div>
            <div class="four push_two columns">
              <a href="/dashboard/menu/{{$menu->id}}/details"><h3 class="edit">Edit Items</h3></a>
              <ul class="box">
                @if(count($menu->navs)>0)
                @foreach($menu->navs as $nav)
                  <li>{{$nav->title}}</li>
                @endforeach
                @else
                  <li>You have no list items, add some!</li>
                @endif
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>




  </form>

  @push('footer')

  @endpush

@endsection
