@extends('dashboard.layout.dashboard')

@section('content')
    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">Forms</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <div class="three columns push_one name-sorting">
          <i class="fas fa-sort-alpha-down" id="reversealphBnt"></i>
          <i class="fas fa-sort-alpha-up-alt" id="alphBnt"></i>
          <input type="text" placeholder="Search Forms..." id="SearchInput" onkeyup="searchFunction()">
        </div>

        <div class="three columns">

        </div>

        <a class="two push_three columns new" href="/dashboard/form/create">
          <i class="fas fa-plus"></i>
        </a>
      </div>
      <div class="dashboard-list">
        <div class="list_zone" id="list_zone">
          @if(count($forms)==0)
            <div class="row">
              <div class="ten push_one columns">
                <p>You have no forms. Try creating one!</p>
              </div>
            </div>
          @endif
          @foreach($forms as $form)
          <div class="row content-item">
            <div class="three push_one columns">
              <p><name>{{$form->title}}</name></p>
            </div>
            <div class="three columns">
              <a href="/dashboard/form/{{$form->slug}}/submissions"><p class="update">{{$form->submissions->count()}} Submissions</p></a>
            </div>
            <div class="two push_one columns">
              <a href="/dashboard/form/{{$form->slug}}/edit"><p class="edit">Edit</p></a>
            </div>
            <div class="two columns">
              <a href="/dashboard/form/{{$form->slug}}/delete"><p class="delete">Delete</p></a>
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
