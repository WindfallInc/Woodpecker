@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/type/store" method="POST" id="write_form">
    {{ csrf_field() }}

    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">New Content Type</h1>
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
                <input type="text" name="title" placeholder="page, post, event, etc" required></p>
                <p>&nbsp;</p>
                <p>Enable Categories
                <input type="checkbox" name="categories" value='1'></p>
                <p>Enable Advanced Content Editor
                <input type="checkbox" name="editor" value='1'></p>
                <p>Time Sensitive Content
                <input type="checkbox" name="time" value='1'></p>
              </div>
              <div class="four push_two columns">
                <p class="select-box">Default Template
                <select name="template" required>
                  <option>Select Default Template </option>
                  @foreach($templates as $template)
                    <option value="{{$template->slug}}">{{$template->title}}</option>
                  @endforeach
                </select>
                <i class="fa fa-sort-desc" aria-hidden="true"></i></p>

              </div>
          </div>
          <div class="row">
            <div class="twelve columns">
              <div class="input_fields_wrap">
              </div>
              <div class="more fa fa-plus-circle"></div>
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

      $(document).ready(function() {
        var max_fields      = 6; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".more"); //Add button ID
        var x = 0;
        var y = {{$lastcustom}};



        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                y++;
                $(wrapper).append('<div class="custom_field row box"><i class="fa fa-minus-circle remove_field"></i> <p>Custom Field Name<input type="text" name="custom_field[]" placeholder="Featured, Has Sidebar, Advertisment" required><input type="hidden" name="custom_id[]" value="'+y+'" required></p><p class="select-box">Custom Field Type<select name="custom_type[]" required><option value="text">Text</option><option value="textbox">Textbox</option><option value="checkbox">Checkbox</option><option value="number">Number</option><option value="date">Date</option></select><i class="fa fa-sort-desc" aria-hidden="true"></i></p></div> '); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            $(this).parent('div').remove();
        });




      });
      $('form').on('submit',function(e){
        e.preventDefault();
        var val = $('select').val();
        if(val == 'Select Default Template'){
          alert(val);
        }
        else {
          this.submit();
        }
      });
    </script>

  @endpush

@endsection

