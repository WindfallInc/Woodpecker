<script>
// Begin functions.image

// auto file preview functions
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
      span.innerHTML = ['<h2>Featured Image</h2><img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" class="media-img"/>'].join('');
      document.getElementById('image').insertBefore(span, null);
    };
  })(f);

  // Read in the image file as a data URL.
  reader.readAsDataURL(f);
}
}

var image = {{$lastImage}};

$(document).on('change', '.additional-image-selector', function(evt){

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

        var span = document.createElement('span');
        span.innerHTML = ['<h2>New Image</h2><img class="media-img" data-id="'+image+'" src="', e.target.result,
                          '" title="', escape(theFile.name), '" />'].join('');
        document.getElementById('additionalimage').insertBefore(span, null);
      };
    })(f);

    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
  }
  image++;
  $(this).css('display','none');
  $('.input_images_wrap').append('<div class="image"><input type="file" name="additionalimages[]" class="additional-image-selector"></div>');
});

document.getElementById('images').addEventListener('change', handleFileSelect, false);


$(document).on('change', '.component-image-selector', function(evt){
var image = $(this).parents('.component-write').find('.component-image');
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

      //alert(e.target.result);
      image.attr("src", e.target.result);
    };
  })(f);

  // Read in the image file as a data URL.
  reader.readAsDataURL(f);
}
});



</script>