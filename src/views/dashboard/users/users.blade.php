@extends('dashboard.layout.dashboard')

@section('content')
    <div class="row no-gutter">
      <p></p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>Users</h3>
      </div>
      <div class="one column">
        <h3>Approved</h3>
      </div>
      <div class="one column">
        <h3>Admin</h3>
      </div>
      <div class="one column">
        <h3>Forms</h3>
      </div>
      <div class="one column">
        <h3>Menus</h3>
      </div>
      <div class="four columns">
      </div>
    </div>

    <div class="row dashboard-list">
      <hr>
      @if(count($dashboards)==0)
        <p>You have no datatypes. Try creating one! Datatypes are the types on centent that will display on your website. Perhaps your website will have "pages" and "posts." You might even want to display "events" or "galleries".</p>
      @endif
      @foreach($dashboards as $dashboard)
      <div class="row">
        <div class="four columns">
          <p>{{$dashboard->name}}</p>
        </div>
        <div class="one columns">
          <p>
            @if($dashboard->confirmed == 1)
              <i class="fa fa-check" aria-hidden="true"></i>
            @else
              <i class="fa fa-times" aria-hidden="true"></i>
            @endif
          </p>
        </div>
        <div class="one columns">
          <p>
            @if($dashboard->admin == 1)
              <i class="fa fa-check" aria-hidden="true"></i>
            @else
              <i class="fa fa-times" aria-hidden="true"></i>
            @endif
          </p>
        </div>
        <div class="one columns">
          <p>
            @if($dashboard->forms == 1)
              <i class="fa fa-check" aria-hidden="true"></i>
            @else
              <i class="fa fa-times" aria-hidden="true"></i>
            @endif
          </p>
        </div>
        <div class="one columns">
          <p>
            @if($dashboard->menus == 1)
              <i class="fa fa-check" aria-hidden="true"></i>
            @else
              <i class="fa fa-times" aria-hidden="true"></i>
            @endif
          </p>
        </div>
        <div class="two columns">
          <a href="/dashboard/user/{{$dashboard->id}}/edit"><p class="edit">Edit</p></a>
        </div>
        <div class="two columns">
          <a href="/dashboard/user/{{$dashboard->id}}/delete"><p class="delete">Delete</p></a>
        </div>
      </div>
      <hr>
      @endforeach
    </div>

@endsection
