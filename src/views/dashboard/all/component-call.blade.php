@extends('dashboard.layout.dashboard')

@section('content')

@component('dashboard.all.dashboard-box')
    @slot('content_type')
        {{$type->title}}
    @endslot
    @slot('type_id')
        {{$type->id}}
    @endslot
    @isset($deleted)
      @slot('deleted')
          {{$deleted}}
      @endslot
    @endisset
    @slot('list_zone')
        @if(count($contents)==0)
          <div class="row">
            <div class="ten push_one columns">
              <p>You have no {{str_plural($type->title)}}. Try creating one!</p>
            </div>
          </div>
        @endif
        @foreach($contents as $content)
          @if($user->canEdit($content->id))
            @include('dashboard.all.box-row')
          @endif
        @endforeach
    @endslot
@endcomponent

@push('footer')
<script>
$(document).ready(function(){

    $(document).on('click', '.edit-link', function(e){
        $('.message').css('top','0px');
    });

});
</script>

@include('dashboard.functions.name-search')
@include('dashboard.functions.status-sorting')
@include('dashboard.functions.name-sorting')
@include('dashboard.functions.date-sorting')
<script>
$(document).ready(function(){

    $(document).on('click', '.edit-link', function(e){
        $('.message').css('top','0px');
    });

});
$(document).on('click', '.published', function(e){
  var postId = $(this).data("id");
  $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });
  $.ajax({
    method: 'POST',
    url: '/dashboard/{{$type->slug}}/active/update',
    data: {postId: postId},
  })
  if($(this).html()=='<i class="fa fa-check" aria-hidden="true"></i>'){
    $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
  }
  else {
    $(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
  }
  $(this).parents('span').css('display','block');
});
</script>
<script>
$(document).on('click', '.delete', function(e){
  var proceed = confirm("Are you sure you would like to delete this {{strtolower($type->title)}}?");
  if (proceed == true)
  {
    var postId = $(this).data("id");
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      method: 'POST',
      url: '/dashboard/@if($type->id != '0'){{$type->id}}@else{{strtolower($type->title)}}@endif/delete',
      data: {postId: postId},
    })

    $(this).parents('.content-item').remove();
  }
  else
  {
    e.preventDefault();
  }
});
</script>
@endpush


@endsection