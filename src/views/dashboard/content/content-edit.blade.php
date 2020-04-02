@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush

  <form action="/dashboard/{{$type->id}}/store/{{$content->id}}" method="POST" enctype="multipart/form-data" id="contentsubmission">
    {{ csrf_field() }}

    @include('dashboard.partials.images-menu')




    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">{{$content->title}}</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <div class="two columns push_one">
          <div class="tab active" data-expand="basic">Basic</div>
        </div>

        <div class="two columns">
          <div class="tab" data-expand="advanced">Advanced</div>
        </div>

        <!--
        <a class="one column push_three" href="/dashboard/{{$type->id}}/restore/{{$content->id}}">
          <i class="fas fa-history"></i>
        </a>
        -->

        <div class="one columns push_four preview-submit">
          <i class="fa fa-lock"></i>
        </div>

        <div class="two columns store">
          <i class="fa fa-sign-in"></i>
        </div>
      </div>
      <div class="dashboard-list">
        <div class="editor_zone" id="editor_zone">
          @include('dashboard.partials.basic-editing')
          @include('dashboard.partials.advanced-editing')
        </div>
      </div>
    </div>

  </form>

  @push('footer')

@include('dashboard.partials.contentoptions')
    <script>
    //order functions for saving
    /*
    $(document).on('submit','#contentsubmission',function(event){
        event.preventDefault();
        $('.notification').css('top','0px');
        var ids = [];

        $('#counter').siblings().each(function () {
         ids.push($(this).data('id'));
        });
        ids.join(',');
        $('#order').val(ids);

        setTimeout( function () {
            $('#contentsubmission').submit();
        }, 500);
    });
    */
    $(document).on('click','.store',function(event){
        $('.notification').css('top','0px');
        var ids = [];

        $('#counter').siblings().each(function () {
         ids.push($(this).data('id'));
        });
        ids.join(',');
        $('#order').val(ids);

        setTimeout( function () {
            $('.notification').addClass('active');
        }, 500);

        setTimeout( function () {
            $('#contentsubmission').submit();
        }, 1000);
    });
    $(document).on('click','.preview-submit',function(event){
        $('.notification').css('top','0px');
        var ids = [];

        $('#counter').siblings().each(function () {
         ids.push($(this).data('id'));
        });
        ids.join(',');
        $('#order').val(ids);
        $('#contentsubmission').attr('action', '/dashboard/{{$type->id}}/store/{{$content->id}}/draft');

        setTimeout( function () {
            $('.notification').addClass('active');
        }, 500);

        setTimeout( function () {
            $('#contentsubmission').submit();
        }, 1000);
    });

    </script>
    @include('dashboard.functions.scrubber')
    @include('dashboard.functions.meta')
    @include('dashboard.functions.prevent')
    @include('dashboard.functions.basic')
    @include('dashboard.functions.content-bar')
    @include('dashboard.functions.components-rows')
    @include('dashboard.functions.toggle-view')
    @include('dashboard.functions.transfer')
    @include('dashboard.functions.image')
    @include('dashboard.functions.categories')
    @include('dashboard.functions.columns')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @include('dashboard.functions.draggable')
    @include('dashboard.functions.links')

  @endpush

@endsection