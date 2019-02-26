<script>

// Begin content functions
var x = {{$last++}}; //initlal text box count
$(document).ready(function() {
  var max_fields      = {{$last++}}+69; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var imgwrapper      = $(".input_images_wrap"); //Fields wrapper
  var add_button      = $(".paragraph-add"); //Add button
  var add_image       = $(".image-add"); //Add button



  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div class="row content-write" data-id="'+x+'"> <div class="content-bar"> <span>Columns<input type="number" name="columns[]" value="1" min="1" max="5" class="column-select" id="row'+x+'"></span> <span><i class="fa fa-header" aria-hidden="true" style="font-size:22px;" onmousedown="h1()"></i> <i class="fa fa-header" aria-hidden="true" style="font-size:18px;" onmousedown="h2()"></i> <i class="fa fa-header" aria-hidden="true" style="font-size:14px;" onmousedown="h3()"></i> <i class="fa fa-header" aria-hidden="true" style="font-size:8px;" onmousedown="h4()"></i> </span> <span><i class="fa fa-bold" aria-hidden="true" onmousedown="bold()"></i> <i class="fa fa-italic" aria-hidden="true" onmousedown="italic()"></i></span> <span><i class="fa fa-align-left" aria-hidden="true" onmousedown="left()"></i> <i class="fa fa-align-center" aria-hidden="true" onmousedown="center()"></i> <i class="fa fa-align-right" aria-hidden="true" onmousedown="right()"></i></span> <i class="fa fa-list" aria-hidden="true" onmousedown="lister()"></i> <i class="fa fa-picture-o" aria-hidden="true" onclick="activate(30000)"></i> <i class="fa fa-link linker" aria-hidden="true"></i> <i class="fa fa-code" aria-hidden="true" onclick="codeview()"></i> <input type="hidden" name="row[]" hidden value="'+x+'"> </div> <i class="fa fa-minus-circle remove_field"></i> <i class="fa fa-arrows-v" aria-hidden="true"></i> <div class="row'+x+'"> <div class="twelve columns transfer"> <div class="textarea active" contenteditable="true" ></div> <textarea name="column[]" class="codearea"></textarea> </div> </div> </div>'); //add input box
      }
      $('#contentoptions').removeClass('active');
  });

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      $(this).parent('div').remove();
  });


  var y = 0;
  $(add_image).click(function(e){ //on add input button click
      e.preventDefault();
      if(y < max_fields){ //max input box allowed
          y++; //text box increment
          $(imgwrapper).append('<div class="image"><input type="file" name="additionalimages[]" class="additional-image-selector"><i class="fa fa-minus-circle remove_image"></i></div>'); //add input box
      }
  });

  $(imgwrapper).on("click",".remove_image", function(e){ //user click on remove
      $(this).parent('div').remove();
  });



});



$(document).on('click', '.add_carousal', function(e){
    e.preventDefault();
        $('.input_carousal_wrap').append('<div class="carousalimage"><input type="file" name="carousalimages[]"><i class="fa fa-minus-circle remove_carousalimage"></i></div>'); //add input box
});

$(document).on('click', '.delete_carousalimage', function(e){
    $(this).parent('div').remove();


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



});


// begin component functions
var z = {{$lastComponent}};
@foreach($components->where('template','1') as $component)


$(document).on('click', '#{{$component->slug}}', function(e){

  var max_fields      = {{$lastComponent++}}+29; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_image       = $(".image-add"); //Add button ID
  var content         = '@include("dashboard.components.form")'
  var preview         = '@include("dashboard.components.preview-".$component->slug)'


    if(z < max_fields){ //max input box allowed
      @if($component->slug == 'carousal')
      $(wrapper).append('<div class="component-write wrap-right {{$component->columns}} columns" id="row'+z+'" data-id="'+z+'"><div class="content-bar"><span>{{$component->title}}<i class="fa fa-pencil" aria-hidden="true"></i></span></div><input type="hidden" value="{{$component->slug}}" name="component-slug[]"><input type="hidden" value="'+z+'" name="component-id[]"><div class="form-backdrop"><div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div><div class="forms">'+content+'<div class="input_carousal_wrap"><div class="carousalimage">Insert Carousal Images<input type="file" name="carousalimages[]"><i class="fa fa-minus-circle remove_carousalimage"></i></div></div><div class="add_carousal fa fa-plus-circle">Add Another Image</div></div></div><div class="preview active">'+preview+'</div> <i class="fa fa-minus-circle remove_field"></i> <i class="fa fa-arrows-v" aria-hidden="true"></i></div>'); //add Carousal
      @else
      $(wrapper).append('<div class="component-write wrap-right {{$component->columns}} columns" id="row'+z+'" data-id="'+z+'"><div class="content-bar"><span>{{$component->title}}<i class="fa fa-pencil" aria-hidden="true"></i></span></div><input type="hidden" value="{{$component->slug}}" name="component-slug[]"><input type="hidden" value="'+z+'" name="component-id[]"><div class="form-backdrop"><div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div><div class="forms">'+content+'</div></div><div class="preview active">'+preview+'</div> <i class="fa fa-minus-circle remove_field"></i> <i class="fa fa-arrows-v" aria-hidden="true"></i></div>'); //add Component
      @endif
      z++; //text box increment
    }
    $('#contentoptions').removeClass('active');
});
@endforeach

// end content functions





</script>