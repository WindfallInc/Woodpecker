@extends('dashboard.layout.dashboard')

@section('content')
    <div class="row">
      <p></p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>Forms</h3>
      </div>
      <div class="four columns">
        <h3>Submissions</h3>
      </div>
      <div class="four columns">
        <a href="/dashboard/form/create"><h3 class="create">New Form</h3></a>
      </div>
    </div>

    <div class="row dashboard-list">
      <hr>
      @if(count($forms)==0)
        <p>You have no forms. Try creating one! Forms can allow you to gather information about your visitors.</p>
      @endif
      @foreach($forms as $form)
      <div class="row">
        <div class="four columns">
          <p>{{$form->title}}</p>
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
      <hr>
      @endforeach
    </div>

@endsection
