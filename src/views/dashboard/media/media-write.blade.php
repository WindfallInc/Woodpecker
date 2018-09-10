@extends('layouts.dashboard')

@section('content')
    <div class="row no-gutter">
      <p></p>
    </div>
    <form action="/dashboard/media/store" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="row heading">
      <div class="four columns">
        <h1>New Media</h1>
      </div>
      <div class="four columns">

      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Media</h3></button>
      </div>
    </div>

    <div class="row box-top">
      <div class="four columns">
        <input type="text" name="title" placeholder="title">
      </div>
      <div class="four columns">
        <input type="file" name="image" id="images">
      </div>
    </div>
    <div class="row img-container">
      <output id="image"></output>
    </div>

    @push('footer')
      <script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

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
