@extends('dashboard.layout.dashboard')

@section('content')

  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush
  <form action="/dashboard/type/store" method="POST" id="type_form">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">Edit {{$type->title}}</h1>
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
              <p>Datatype Title
              <input type="text" name="title" value="{{$type->title}}"></p>
              <p>Datatype slug
              <input type="text" readonly name="slug" value="{{$type->slug}}"></p>
              <p class="mini">Note that all slugs update automatically with their corresponding titles</p>
              <p>Enable Categories
              <input type="checkbox" name="categories" value='1' @if($type->categories=='1')checked @endif></p>
              <p>Enable Advanced Content Editor
              <input type="checkbox" name="editor" value='1' @if($type->editor=='1')checked @endif></p>
              <p>Time Sensitive Content
              <input type="checkbox" name="time" value='1' @if($type->time=='1')checked @endif></p>
            </div>
            <div class="four push_two columns">
              <p class="select-box">Default Template
              <select name="template">
                @foreach($templates as $template)
                  <option value="{{$template->slug}}" @if($template->slug == $type->templates->first()->slug) selected @endif>{{$template->title}}</option>
                @endforeach
              </select>
              <i class="fa fa-sort-desc" aria-hidden="true"></i></p>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row -padding-top">
      <div class="twelve columns">
        <div class="input_fields_wrap">

          @foreach($type->custom_fields as $custom)
            <div class="dashboard-box custom_field row box">
              <i class="fa fa-minus-circle remove_field" data-id="{{$custom->id}}"></i></a>
              <p>Custom Field Name
                <input type="text" name="custom_field[]" value="{{$custom->name}}" required>
                <input type="hidden" name="custom_id[]" value="{{$custom->id}}" required>
              </p>
              <p class="select-box">Custom Field Type
                <select name="custom_type[]" required>
                  <option value="{{$custom->input}}">{{$custom->input}}</option>
                  <option value="text">Text</option>
                  <option value="textbox">Textbox</option>
                  <option value="checkbox">Checkbox</option>
                  <option value="number">Number</option>
                  <option value="date">Date</option>
                </select>
                <i class="fa fa-sort-desc" aria-hidden="true"></i>
              </p>
            </div>
          @endforeach

        </div>
        <div class="more fa fa-plus-circle"></div>
      </div>
    </div>

  </form>

  @push('footer')

<script>
    $(document).ready(function() {
      var max_fields      = 16; //maximum input boxes allowed
      var wrapper         = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".more"); //Add button ID
      var x = $('.input_fields_wrap').children().length;
      var y = {{$lastcustom}};



      $(add_button).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              y++;
              $(wrapper).append('<div class="dashboard-box custom_field row box"><i class="fa fa-minus-circle remove_field"></i> <p>Custom Field Name<input type="text" name="custom_field[]" placeholder="Featured, Has Sidebar, Advertisment" required><input type="hidden" name="custom_id[]" value="'+y+'" required></p><p class="select-box">Custom Field Type<select name="custom_type[]" required><option value="text">Text</option><option value="textbox">Textbox</option><option value="checkbox">Checkbox</option><option value="number">Number</option><option value="date">Date</option></select><i class="fa fa-sort-desc" aria-hidden="true"></i></p></div> '); //add input box
          }
      });

      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
          $(this).parent('div').remove();
      });




    });
</script>
<script>
$(document).on('click', '.remove_field', function(e){
  var postId = $(this).data("id");
  if(postId == null){
  } else {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
      method: 'POST',
      url: '/dashboard/customfield/{{$type->id}}/delete',
      data: {postId: postId},
    })
  }
});
</script>
<script>
  $(document).on('click','.store',function(event){
      $('.notification').css('top','0px');

      setTimeout( function () {
          $('.notification').addClass('active');
      }, 500);

      setTimeout( function () {
          $('#type_form').submit();
      }, 1000);
  });
</script>
  @endpush

@endsection
