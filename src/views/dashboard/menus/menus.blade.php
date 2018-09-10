@extends('layouts.dashboard')

@section('content')
    <div class="row no-gutter">
      <p></p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>Menus</h3>
      </div>
      <div class="four columns">
        <h3>Edited</h3>
      </div>
      <div class="four columns">
        <a href="/dashboard/menu/create"><h3 class="create">New Menu</h3></a>
      </div>
    </div>

    <div class="row dashboard-list">
      <hr>
      @if(count($menus)==0)
        <p>You have no menus. Try creating one! Menus are integral to any website. How else will people navigate their way around?</p>
      @endif
      @foreach($menus as $menu)
      <div class="row">
        <div class="four columns">
          <p>{{$menu->title}}</p>
        </div>
        <div class="four columns">
          <p>{{date('M j, Y',strtotime($menu->updated_at))}}</p>
        </div>
        <div class="two columns">
          <a href="/dashboard/menu/{{$menu->slug}}/edit"><p class="edit">Edit</p></a>
        </div>
        <div class="two columns">
          <a href="/dashboard/menu/{{$menu->slug}}/delete"><p class="delete">Delete</p></a>
        </div>
      </div>
      <hr>
      @endforeach
    </div>

@endsection
