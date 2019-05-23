@extends('dashboard.layout.dashboard')

@section('content')

  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush
  <form action="/dashboard/user/{{$dashboard->id}}/edit" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>{{$dashboard->name}}</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Datatype</h3></button>
      </div>
    </div>

    <div class="row box-bot">

      <div class="six columns">
        <p>Username
        <input type="text" name="name" value="{{$dashboard->name}}"></p>
        <p>Email
        <input type="text" name="email" value="{{$dashboard->email}}"></p>
        <p>Administrator
        <input type="checkbox" name="admin" value='1' @if($dashboard->admin=='1')checked @endif></p>
        <p>This user can edit forms
        <input type="checkbox" name="forms" value='1' @if($dashboard->forms=='1')checked @endif></p>
        <p>This user can edit menus
        <input type="checkbox" name="menus" value='1' @if($dashboard->menus=='1')checked @endif></p>
        <p>This user has been approved
        <input type="checkbox" name="confirmed" value='1' @if($dashboard->confirmed=='1')checked @endif></p>
      </div>

    </div>

    <div class="row">
      <div class="eight columns">
        <p>To limit a user so that they can only edit specific content, you can change the options below. You can limit a user to specific pages, or content types.</p>
      </div>
    </div>

    <div class="row">
      <div class="six columns">
        <h3>Content Types</h3>
        @foreach ($types as $type)
          <p>{{$type->title}}
          <input type="checkbox" name="typepermissions[]" value='{{$type->id}}' @if($dashboard->canEditType($type->id))checked @endif @if($dashboard->isAdmin())checked @endif)></p>
        @endforeach
      </div>
      <div class="six columns">
        <h3>Individual Content</h3>
      </div>
    </div>


  </form>

@push('footer')
<script>

</script>
@endpush

@endsection
