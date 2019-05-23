@extends('dashboard.layout.dashboard')

@section('content')
    <div class="row no-gutter">
      <p></p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>Datatypes</h3>
      </div>
      <div class="four columns">
        <h3>Created at</h3>
      </div>
      <div class="four columns">
        <a href="/dashboard/type/create"><h3 class="create">New Datatype</h3></a>
      </div>
    </div>

    <div class="row dashboard-list">
      <hr>
      @if(count($types)==0)
        <p>You have no datatypes. Try creating one! Datatypes are the types on centent that will display on your website. Perhaps your website will have "pages" and "posts." You might even want to display "events" or "galleries".</p>
      @endif
      @foreach($types as $type)
        @if($user->canEditType($type->id))
          <div class="row">
            <div class="four columns">
              <p>{{$type->title}}</p>
            </div>
            <div class="four columns">
              <p>{{date('M j, Y',strtotime($type->created_at))}}</p>
            </div>
            <div class="two columns">
              <a href="/dashboard/type/{{$type->slug}}/edit"><p class="edit">Edit</p></a>
            </div>
            <div class="two columns">
              <a href="/dashboard/type/{{$type->slug}}/delete"><p class="delete">Delete</p></a>
            </div>
          </div>
          <hr>
        @endif
      @endforeach
    </div>

@endsection
