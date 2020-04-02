@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/media/store" method="POST" id="write_form" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">New Media</h1>
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
                <input type="text" name="title" placeholder="title">
                <input type="file" name="image" id="images">
              </div>
              <div class="eight columns">
                <output id="image"></output>
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


      function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

          // Only process image files.
          if (!f.type.match('image.*')) {
            $('#image').addClass('fa fa-file');
            continue;
          }
          $('#image').removeClass('fa fa-file');

          var reader = new FileReader();

          // Closure to capture the file information.
          reader.onload = (function(theFile) {
            return function(e) {
              // Render thumbnail.
              var span = document.createElement('span');
              span.innerHTML = ['<img class="thumb" src="', e.target.result,
                                '" title="', escape(theFile.name), '" class="media-img"/>'].join('');
              document.getElementById('image').insertBefore(span, null);
            };
          })(f);

          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
      }

      document.getElementById('images').addEventListener('change', handleFileSelect, false);
    </script>

  @endpush

@endsection

