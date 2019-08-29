@extends('dashboard.layout.dashboard')

@section('content')
  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush

  <div class="message" style="position:fixed; top:-150px; background-color:#F18F01; left:0px; padding:20px; color:#fff; transition:linear all .2s; width:100vw; text-align:center;">
    <p>PATH COPIED</p>
  </div>

    <div class="row">
      <p></p>
    </div>
    <div class="row heading">
      <div class="four columns">
        <h3>Media</h3>
      </div>
      <div class="four columns">

      </div>
      <div class="four columns">
        <a href="/dashboard/media/create"><h3 class="create">New Media</h3></a>
      </div>
    </div>



    <div class="row dashboard-list">
      <div class="tab" data-expand="feats">Featured Images</div><div class="tab" data-expand="files">Documents</div><div class="tab" data-expand="media-images">Images</div>

      <div class="expand-tab files" id="files">
      @foreach($files->sortByDesc('updated_at') as $file)


            @if($loop->first)
              <div class="row media-file">
            @endif

            <div class="twelve columns img-container" style="justify-content:left;">
              <p>File slug: {{$file->slug}}
              <br>File path: <span class="copy">{{$file->path}}</span>
              <br><a href="{{$file->path}}" target="_blank">View File</a></p>
              <i class="fa fa-eraser" aria-hidden="true" data-id="{{$file->id}}"></i>
            </div>

            @if($loop->iteration % 1 == 0)
            </div>
            <div class="row media-file">
            @endif

            @if($loop->last)
            </div>
            @endif
      @endforeach
      </div>

      <div class="expand-tab featured-images" id="feats">
        @foreach($feats as $feat)

          @if($loop->first)
            <div class="row">
          @endif

          <div class="three columns img-container">
            <img src="{{$feat->thumbnail}}" alt="{{$feat->slug}}" class="media-img">
            @foreach($feat->contents as $page)
              <a href="/dashboard/{{$page->type_id}}/{{$page->id}}/edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
            @endforeach

          </div>


          @if($loop->iteration % 4 == 0)
          </div>
          <hr>
          <div class="row">
          @endif

          @if($loop->last)
          </div>
          @endif

        @endforeach
      </div>

      <div class="expand-tab media-images" id="media-images">
        @foreach($images as $image)

          @if($loop->first)
            <div class="row">
          @endif

          <div class="two columns img-container">
            <img src="{{$image->path}}" alt="{{$image->slug}}" class="media-img">
            <i class="fa fa-eraser" aria-hidden="true" data-id="{{$image->id}}"></i>
          </div>

          @if($loop->iteration % 6 == 0)
          </div>
          <hr>
          <div class="row">
          @endif

          @if($loop->last)
          </div>
          @endif

        @endforeach
      </div>

    </div>
<script>
    $(document).on('click', '.fa-eraser', function(e){
      var mediaId = $(this).data("id");
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/dashboard/media/delete',
        data: {mediaId: mediaId},
      })

      $(this).parent('div').remove();
    });

    $(document).on('click', '.media-img', function(e){
        var path = $(this).attr('src');
        var temp = $("<input>");
        $("body").append(temp);
        temp.val(path).select();
        document.execCommand("copy");
        temp.remove();
        $('.message').css('top','0px');
        setTimeout( function () {
            $('.message').css('top','-150px');
        }, 1500);
    });
    $(document).on('click', '.copy', function(e){
        var path = $(this).text();
        var temp = $("<input>");
        $("body").append(temp);
        temp.val(path).select();
        document.execCommand("copy");
        temp.remove();
        $('.message').css('top','0px');
        setTimeout( function () {
            $('.message').css('top','-150px');
        }, 1500);
    });
</script>

<script>
  $(document).on('click', '.tab', function(e){
    $('.expand-tab').removeClass('active');
    $('.tab').removeClass('active');
    $(this).addClass('active');
    var expand = $(this).data('expand');
    $('#'+expand).addClass('active');
  });
</script>

@endsection
