@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/menu/store" method="POST" id="write_form">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">New Menu</h1>
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
          <div class="row -padding">
            <div class="four columns">
              <p>Menu Title
              <input type="text" name="title" placeholder="Main nav, top nav, sidebar, etc..."></p>
            </div>
            <div class="four columns">
              <p>Templates</p>
              @foreach($templates as $template)
                <p>
                <label class="switch"><input value="{{$template->id}}" name="templates[]" type="checkbox" class="tinycheck"><span class="slider round"></span></label>{{$template->title}}</p>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>




  </form>

  @push('footer')
    <script>
      $(document).on('click','.store',function(event){
          $('.notification').css('top','0px');

          setTimeout( function () {
              $('.notification').addClass('active');
          }, 500);

          setTimeout( function () {
              $('#write_form').submit();
          }, 1000);
      });
    </script>

  @endpush

@endsection
