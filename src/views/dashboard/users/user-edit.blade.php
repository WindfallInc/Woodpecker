@extends('dashboard.layout.dashboard')

@section('content')

  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush

  <div class="row">
    <div class="ten push_one columns strip">
      <h1 class="-brown">{{$dashboard->name}}</h1>
    </div>
  </div>
  <div class="dashboard-box row">
    <div class="box-header row">
      <div class="ten columns"></div>
      <div class="two columns store">
        <i class="fa fa-sign-in"></i>
      </div>
    </div>
    <div class="dashboard-list">
      <div class="editor_zone" id="editor_zone">
        <form action="/dashboard/user/{{$dashboard->id}}/edit" method="POST" id="user_form">
          {{ csrf_field() }}
          <div class="row -padding">

            <div class="six columns">
              <p>Username
              <input type="text" name="name" value="{{$dashboard->name}}"></p>
              <p>Email
              <input type="text" name="email" value="{{$dashboard->email}}"></p>
              <p><label class="switch"><input type="checkbox" name="admin" value='1' @if($dashboard->admin=='1')checked @endif><span class="slider round"></span></label>&nbsp;Administrator</p>
              <p><label class="switch"><input type="checkbox" name="forms" value='1' @if($dashboard->forms=='1')checked @endif><span class="slider round"></span></label>&nbsp;This user can edit forms</p>
              <p><label class="switch"><input type="checkbox" name="menus" value='1' @if($dashboard->menus=='1')checked @endif><span class="slider round"></span></label>&nbsp;This user can edit menus</p>
              <p><label class="switch"><input type="checkbox" name="confirmed" value='1' @if($dashboard->confirmed=='1')checked @endif><span class="slider round"></span></label>&nbsp;This user has been approved</p>
            </div>

          </div>

          <div class="row -padding">
            <div class="eight columns">
              <p>To limit a user so that they can only edit specific content, you can change the options below.</p>
            </div>
          </div>

          <div class="row -padding">
            <div class="six columns">
              <h3>Content Types</h3>
              @foreach ($types as $type)
                <p><label class="switch"><input type="checkbox" name="typepermissions[]" value='{{$type->id}}' @if($dashboard->canEditType($type->id))checked @endif @if($dashboard->isAdmin())checked @endif)><span class="slider round"></span></label>
                  &nbsp;{{$type->title}}</p>
              @endforeach
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>


@push('footer')
  <script>
    $(document).on('click','.store',function(event){
        $('.notification').css('top','0px');

        setTimeout( function () {
            $('.notification').addClass('active');
        }, 500);

        setTimeout( function () {
            $('#user_form').submit();
        }, 1000);
    });
  </script>
@endpush

@endsection
