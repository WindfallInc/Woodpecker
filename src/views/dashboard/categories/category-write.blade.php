@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/category/store" method="POST" id="category_form">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">New Category</h1>
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
              <p>Category Title
              <input type="text" name="title"> </p>
            </div>
            <div class="four push_two columns">

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
              $('#category_form').submit();
          }, 1000);
      });
    </script>

  @endpush

@endsection
