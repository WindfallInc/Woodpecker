@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/setting/store" method="POST" id="setting_form">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">Edit {{$setting->title}}</h1>
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
              <p>Setting Type
              <input type="text" name="name" value="{{$setting->name}}"></p>
              <p>Setting Content
              <input type="text" name="content" value="{{$setting->content}}"></p>
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
              $('#setting_form').submit();
          }, 1000);
      });
    </script>

  @endpush

@endsection
