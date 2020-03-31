
@extends('dashboard.layout.dashboard')

@section('content')
    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">Users</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <div class="two columns push_one name-sorting">
          <i class="fas fa-sort-alpha-down" id="reversealphBnt"></i>
          <i class="fas fa-sort-alpha-up-alt" id="alphBnt"></i>
          <input type="text" placeholder="Search Forms..." id="SearchInput" onkeyup="searchFunction()">
        </div>

        <div class="two columns">
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

        
      </div>
      <div class="dashboard-list">
        <div class="list_zone" id="list_zone">
          @if(count($dashboards)==0)
            <div class="row">
              <div class="ten push_one columns">
                <p>There are no users!</p>
              </div>
            </div>
          @endif
          @foreach($dashboards as $dashboard)
            <div class="row content-item">
              <div class="two push_one columns">
                <p>{{$dashboard->name}}</p>
              </div>
              <div class="two columns">
                <p>
                  @if($dashboard->confirmed == 1)
                    <i class="fa fa-check" aria-hidden="true"></i>
                  @else
                    <i class="fa fa-times" aria-hidden="true"></i>
                  @endif
                </p>
              </div>
              <div class="one column">
                <p>
                  @if($dashboard->admin == 1)
                    <i class="fa fa-check" aria-hidden="true"></i>
                  @else
                    <i class="fa fa-times" aria-hidden="true"></i>
                  @endif
                </p>
              </div>
              <div class="one column">
                <p>
                  @if($dashboard->forms == 1)
                    <i class="fa fa-check" aria-hidden="true"></i>
                  @else
                    <i class="fa fa-times" aria-hidden="true"></i>
                  @endif
                </p>
              </div>
              <div class="one column">
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
          @endforeach
        </div>
      </div>
    </div>

    @push('footer')
      @include('dashboard.functions.name-search')
      @include('dashboard.functions.name-sorting')
    @endpush

@endsection
