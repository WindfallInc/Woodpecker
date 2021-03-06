@extends('dashboard.layout.dashboard')

@section('content')

@push('header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

<form action="/dashboard/form/{{$form->id}}/update" method="POST" id="question-form">
  {{ csrf_field() }}

  <div class="row">
    <div class="ten push_one columns strip">
      <h1 class="-brown">{{$form->title}}</h1>
    </div>
  </div>
  <div class="dashboard-box row">

    <div class="box-header row">
      <div class="ten columns">

      </div>

      <div class="two columns store">
        <i class="fa fa-sign-in"></i>
      </div>
    </div>
    <div class="dashboard-list">
      <div class="editor_zone" id="editor_zone">
        <div class="row">
          <div class="six push_one columns">

              <div class="form-creator" id="sortable">
                  <div id="counter"><input type="hidden" value="" name="order" id="order"></div>
              @if(count($form->questions)>0)
                @foreach($form->questions->sortBy('order') as $q)
                  @if($q->type == 'radio')
                    <div class="question row" data-id="{{$q->id}}">
                      <div class="four columns question-input">
                        <input type="text" name="title{{$q->id}}" value="{{$q->title}}">
                      </div>
                      <div class="eight columns question-input">
                        <input type="hidden" name="columns{{$q->id}}" value="twelve">
                        <input type="hidden" name="type{{$q->id}}" value="radio">
                        <div class="radiochildren">
                          @foreach($q->children() as $child)
                          <div class="row">
                            <div class="six columns">
                              <label for="child{{$q->id}}">Option {{$loop->iteration}}</label>
                              <input type="text" name="child{{$q->id}}[]" value="{{$child->title}}">
                              <input type="hidden" name="childid{{$q->id}}[]" value="{{$child->id}}">
                            </div>
                            <div class="six columns">
                              <label for="childcolumns{{$q->id}}">Size</label>
                              <select name="childcolumns{{$q->id}}[]">
                                <option value="twelve" @if($child->columns == 'twelve')selected @endif>Full Row</option>
                                <option value="six" @if($child->columns == 'six')selected @endif>Half Row</option>
                                <option value="four" @if($child->columns == 'four')selected @endif>Third Row</option>
                                <option value="three" @if($child->columns == 'three')selected @endif>Fourth Row</option>
                              </select>
                            </div>
                            <div class="remove_option">Remove</div>
                          </div>
                          @endforeach
                        </div>
                        <div class="addchild fa fa-plus-circle" aria-hidden="true" data-id="{{$q->id}}"></div>
                      </div>
                      <div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div>
                      <div class="outside-link">
                        <div class="required">
                          Required &nbsp;
                          <label class="switch"><input type="checkbox" name="required{{$q->id}}" id="target" value="on" @if($q->required == 1)checked @endif><span class="slider round"></span></label>
                        </div>
                      </div>
                      <i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                  @elseif($q->type == 'select')
                    <div class="question row" data-id="{{$q->id}}">
                      <div class="four columns question-input">
                        <input type="text" name="title{{$q->id}}" value="{{$q->title}}">
                      </div>
                      <div class="eight columns question-input">
                        <input type="hidden" name="columns{{$q->id}}" value="twelve">
                        <input type="hidden" name="type{{$q->id}}" value="select">
                        <div class="selectchildren">
                          @foreach($q->children() as $child)
                          <div class="row">
                            <div class="twelve columns">
                              <label for="child{{$q->id}}">Option {{$loop->iteration}}</label>
                              <input type="text" name="child{{$q->id}}[]" value="{{$child->title}}">
                              <input type="hidden" name="childid{{$q->id}}[]" value="{{$child->id}}">
                            </div>
                            <div class="remove_option">Remove</div>
                          </div>
                          @endforeach
                        </div>
                        <div class="addselectchild fa fa-plus-circle" aria-hidden="true" data-id="{{$q->id}}"></div>
                      </div>
                      <div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div>
                      <div class="outside-link">
                        <div class="required">
                          Required &nbsp;
                          <label class="switch"><input type="checkbox" name="required{{$q->id}}" id="target" value="on"@if($q->required == 1)checked @endif><span class="slider round"></span></label>
                        </div>
                      </div>
                      <i class="fa fa-arrows-v" aria-hidden="true"></i>
                    </div>
                  @elseif($q->type == 'checkbox-group')
                    <div class="question row" data-id="{{$q->id}}">
                      <div class="four columns question-input">
                        <input type="text" name="title{{$q->id}}" value="{{$q->title}}">
                      </div>
                      <div class="eight columns question-input">
                        <input type="hidden" name="columns{{$q->id}}" value="twelve">
                        <input type="hidden" name="type{{$q->id}}" value="checkbox-group">
                        <div class="radiochildren">
                          @foreach($q->children() as $child)
                          <div class="row">
                            <div class="six columns">
                              <label for="child{{$q->id}}">Option {{$loop->iteration}}</label>
                              <input type="text" name="child{{$q->id}}[]" value="{{$child->title}}">
                              <input type="hidden" name="childid{{$q->id}}[]" value="{{$child->id}}">
                            </div>
                            <div class="remove_option">Remove</div>
                          </div>
                          @endforeach
                        </div>
                        <div class="addcheckboxchild fa fa-plus-circle" aria-hidden="true" data-id="{{$q->id}}"></div>
                      </div>
                      <div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div>
                      <div class="outside-link">
                        <div class="required">
                          Required &nbsp;
                          <label class="switch"><input type="checkbox" name="required{{$q->id}}" id="target" value="on" @if($q->required == 1)checked @endif><span class="slider round"></span></label>
                        </div>
                      </div>
                      <i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                  @else
                    <div class="question row" data-id="{{$q->id}}">
                      <div class="four columns question-input">
                        <input type="text" name="title{{$q->id}}" value="{{$q->title}}">
                      </div>
                      <div class="four columns question-input">
                        <select name="columns{{$q->id}}">
                          <option value="twelve" @if($q->columns == 'twelve')selected @endif>Full Row</option>
                          <option value="six" @if($q->columns == 'six')selected @endif>Half Row</option>
                          <option value="four"@if($q->columns == 'four')selected @endif>Third Row</option>
                          <option value="three"@if($q->columns == 'three')selected @endif>Fourth Row</option>
                        </select>
                      </div>
                      <div class="four columns question-input">
                        <select id="type" name="type{{$q->id}}">
                          <option value="{{$q->type}}" selected>{{ucfirst($q->type)}}</option>
                          <option value="text">Text</option>
                          <option value="number">Number</option>
                          <option value="email">Email</option>
                          <option value="text-area">Paragraph</option>
                          <option value="date">Date</option>
                          <option value="checkbox">Checkbox</option>
                          <option value="Radio">Radio</option>
                        </select>
                      </div>
                      <div class="remove_field">
                        Delete Question
                        <div class="warning">
                          Warning: Removing this field may result in a loss of data to any prexsiting form submissions.
                        </div>
                      </div>
                      <div class="outside-link">
                        <div class="required">
                          Required &nbsp;
                          <label class="switch"><input type="checkbox" name="required{{$q->id}}" id="target" value="1"@if($q->required == 1)checked @endif><span class="slider round"></span></label>
                        </div>
                      </div>
                      <i class="fa fa-arrows-v" aria-hidden="true"></i>
                    </div>
                  @endif

                @endforeach
              @endif
              </div>
            </form>

          </div>
          <div class="five columns">
            <h3>New Form Question</h3>
            <p><input type="text" name="title" placeholder="Title - What are you asking about?" id="title" required></p>
            <p>
              <select id="columns">
                <option value="twelve">Full Row</option>
                <option value="six">Half Row</option>
                <option value="four">Third Row</option>
                <option value="three">Fourth Row</option>
              </select>
            </p>
            <p>
              <select id="question">
                <option value="text">Text</option>
                <option value="number">Number</option>
                <option value="email">Email</option>
                <option value="text-area">Paragraph</option>
                <option value="date">Date</option>
                <option value="checkbox">Checkbox</option>
                <option value="checkbox-group">Checkbox Group</option>
                <option value="radio">Radio</option>
                <option value="select">Select Box</option>
                <option value="section">Section Text</option>
              </select>
            </p>
            <p class="create add_question">ADD QUESTION</p>
          </div>

        </div>
      </div>
    </div>
  </div>
</form>


  @push('footer')
    <script>
    var max_fields      = 69; //maximum additions allowed
    var wrapper         = $(".form-creator"); //Fields wrapper
    var add_nav         = $(".add_question"); //Add button ID
    var add_child         = $(".add_child"); //Add button ID
    var id              = {{$lastQuestion}};
    var x = 0; //initlal text box count
    $(document).ready(function() {




      $(add_nav).click(function(e){ //on add input button click
        var title           = $("#title").val();
        var type            = $("#question option:selected").val();
        var columns         = $('#columns option:selected').val();
        var coltext         = $('#columns option:selected').text();
          id++;
          e.preventDefault();
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              if(type == 'section'){
                $(wrapper).append('<div class="question row" data-id="'+id+'"><div class="eight columns question-input"><input type="text" name="title'+id+'" value="'+title+'"></div><div class="four columns question-input"><select name="columns'+id+'"><option value="'+columns+'">'+coltext+'</option><option value="twelve">Full Row</option><option value="six">Half Row</option><option value="four">Third Row</option><option value="three">Fourth Row</option></select><input type="hidden" name="type'+id+'" value="section"></div><div class="remove_field">Delete section text<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div><i class="fa fa-arrows-v" aria-hidden="true"></i></div>'); //add
              } else if(type == 'radio'){

                var parent = id;
                // start parent
                var start = '<div class="question row" data-id="'+id+'"><div class="four columns question-input"><input type="text" name="title'+id+'" value="'+title+'"></div><div class="eight columns question-input"><input type="hidden" name="columns'+id+'" value="twelve"><input type="hidden" name="type'+id+'" value="radio">';
                // add first child
                id++;
                x++;
                var firstChild = '<div class="radiochildren"><div class="row"><div class="six columns"><label for="child'+parent+'">Option 1</label><input type="text" name="child'+parent+'[]" placeholder="yes"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="six columns"><label for="childcolumns'+parent+'">Size</label><select name="childcolumns'+parent+'[]"><option value="twelve">Full Row</option><option value="six" selected>Half Row</option><option value="four">Third Row</option><option value="three">Fourth Row</option></select></div><div class="remove_option">Remove</div></div>';
                // add second child
                id++;
                x++;
                var secondChild = '<div class="row"><div class="six columns"><label for="child'+parent+'">Option 2</label><input type="text" name="child'+parent+'[]" placeholder="no"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="six columns"><label for="childcolumns'+parent+'">Size</label><select name="childcolumns'+parent+'[]"><option value="twelve">Full Row</option><option value="six" selected>Half Row</option><option value="four">Third Row</option><option value="three">Fourth Row</option></select></div><div class="remove_option">Remove</div></div></div><div class="addchild fa fa-plus-circle" aria-hidden="true" data-id="'+parent+'"></div>';
                // close parent
                var end = '</div><div class="outside-link"><div class="required">Required &nbsp;<label class="switch"><input type="checkbox" name="required'+parent+'" id="target" value="1"><span class="slider round"></span></label></div></div><div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div><i class="fa fa-arrows-v" aria-hidden="true"></i></div>';
                // Make up for new question ids

                // append
                $(wrapper).append(start+firstChild+secondChild+end);
              }
              else if(type == 'checkbox-group'){

                var parent = id;
                // start parent
                var start = '<div class="question row" data-id="'+id+'"><div class="four columns question-input"><input type="text" name="title'+id+'" value="'+title+'"></div><div class="eight columns question-input"><input type="hidden" name="columns'+id+'" value="twelve"><input type="hidden" name="type'+id+'" value="checkbox-group">';
                // add first child
                id++;
                x++;
                var firstChild = '<div class="radiochildren"><div class="row"><div class="six columns"><label for="child'+parent+'">Option 1</label><input type="text" name="child'+parent+'[]"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="remove_option">Remove</div></div>';
                // add second child
                id++;
                x++;
                var secondChild = '<div class="row"><div class="six columns"><label for="child'+parent+'">Option 2</label><input type="text" name="child'+parent+'[]"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="remove_option">Remove</div></div></div><div class="addcheckboxchild fa fa-plus-circle" aria-hidden="true" data-id="'+parent+'"></div>';
                // close parent
                var end = '</div><div class="outside-link"><div class="required">Required &nbsp;<label class="switch"><input type="checkbox" name="required'+parent+'" id="target" value="1"><span class="slider round"></span></label></div></div><div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div><i class="fa fa-arrows-v" aria-hidden="true"></i></div>';
                // Make up for new question ids

                // append
                $(wrapper).append(start+firstChild+secondChild+end);
              }
               else if(type == 'select'){
                 var parent = id;
                 // start parent
                 var start = '<div class="question row" data-id="'+id+'"><div class="four columns question-input"><input type="text" name="title'+id+'" value="'+title+'"></div><div class="eight columns question-input"><input type="hidden" name="columns'+id+'" value="twelve"><input type="hidden" name="type'+id+'" value="select">';
                 // add first child
                 id++;
                 x++;
                 var firstChild = '<div class="selectchildren"><div class="row"><div class="twelve columns"><label for="child'+parent+'">Option 1</label><input type="text" name="child'+parent+'[]" placeholder="yes"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="remove_option">Remove</div></div>';
                 // add second child
                 id++;
                 x++;
                 var secondChild = '<div class="row"><div class="twelve columns"><label for="child'+parent+'">Option 2</label><input type="text" name="child'+parent+'[]" placeholder="no"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="remove_option">Remove</div></div></div><div class="addselectchild fa fa-plus-circle" aria-hidden="true" data-id="'+parent+'"></div>';
                 // close parent
                 var end = '</div><div class="outside-link"><div class="required">Required &nbsp;<label class="switch"><input type="checkbox" name="required'+parent+'" id="target" value="1"><span class="slider round"></span></label></div></div><div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div><i class="fa fa-arrows-v" aria-hidden="true"></i></div>';
                 // Make up for new question ids

                 // append
                 $(wrapper).append(start+firstChild+secondChild+end);
               }
              else {
                $(wrapper).append('<div class="question row" data-id="'+id+'"><div class="four columns question-input"><input type="text" name="title'+id+'" value="'+title+'"></div><div class="four columns question-input"><select name="columns'+id+'"><option value="'+columns+'">'+coltext+'</option><option value="twelve">Full Row</option><option value="six">Half Row</option><option value="four">Third Row</option><option value="three">Fourth Row</option></select></div><div class="four columns question-input"><select id="type" name="type'+id+'"><option value="'+type+'" selected>'+type.replace(/^\w/, c => c.toUpperCase())+'</option><option value="text">Text</option><option value="number">Number</option><option value="email">Email</option><option value="text-area">Paragraph</option><option value="date">Date</option><option value="checkbox">Checkbox</option><option value="Radio">Radio</option></select></div><div class="remove_field">Delete Question<div class="warning">Warning: Removing this field may result in a loss of data to any prexsiting form submissions.</div></div><div class="outside-link"><div class="required">Required &nbsp;<label class="switch"><input type="checkbox" name="required'+parent+'" id="target" value="1"><span class="slider round"></span></label></div></div><i class="fa fa-arrows-v" aria-hidden="true"></i></div>'); //add
              }
          }
      });



      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
          $(this).parent('div').remove();
      });
      $(wrapper).on("click",".remove_option", function(e){ //user click on remove text
          $(this).parent('div').remove();
      });
    });

    $(document).on('click', '.addchild' , function(e){
      parent = $(this).data('id');
      var childwrapper = $(this).siblings('.radiochildren');
      x++;
      id++;
      $(childwrapper).append('<div class="row"><div class="six columns"><label for="child'+parent+'">Option</label><input type="text" name="child'+parent+'[]" placeholder="button value"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div><div class="six columns"><label for="childcolumns'+parent+'">Size</label><select name="childcolumns'+parent+'[]"><option value="twelve">Full Row</option><option value="six">Half Row</option><option value="four" selected>Third Row</option><option value="three">Fourth Row</option></select></div></div>');
    });

    $(document).on('click', '.addcheckboxchild' , function(e){
      parent = $(this).data('id');
      var childwrapper = $(this).siblings('.radiochildren');
      x++;
      id++;
      $(childwrapper).append('<div class="row"><div class="six columns"><label for="child'+parent+'">Option</label><input type="text" name="child'+parent+'[]" placeholder="button value"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div>');
    });

    $(document).on('click', '.addselectchild' , function(e){
      parent = $(this).data('id');
      var childwrapper = $(this).siblings('.selectchildren');
      x++;
      id++;
      $(childwrapper).append('<div class="selectchildren"><div class="row"><div class="twelve columns"><label for="child'+parent+'">Option</label><input type="text" name="child'+parent+'[]" placeholder="button value"><input type="hidden" name="childid'+parent+'[]" value="'+id+'"></div></div>');
    });

    $(document).on('click', '.store', function(){
      $('.notification').css('top','0px');
      var ids = [];


      $('#counter').siblings().each(function () {
       ids.push($(this).data('id'));
      });
      ids.join(',');
      $('#order').val(ids);

      setTimeout( function () {
          $('.notification').addClass('active');
          $('#question-form').submit();
      }, 2000);
    });
    </script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @include('dashboard.functions.draggable')
  @endpush

@endsection
