@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush
<div class="message" style="position:fixed; top:-150px; background-color:#F18F01; left:0px; padding:20px; color:#fff; transition:linear all .2s; width:100vw; text-align:center;">
  <p>LOADING...</p>
</div>

  <form action="/dashboard/{{$type->id}}/store/{{$content->id}}" method="POST" enctype="multipart/form-data" id="contentsubmission">
    {{ csrf_field() }}

    @include('dashboard.partials.images-menu')


    <div class="row heading">
      <div class="four columns">
        <h3>{{$content->title}}</h3>
      </div>
      <div class="four columns">
        <button class="nope" onclick='this.form.action="/dashboard/{{$type->id}}/store/{{$content->id}}/draft";'><h3 class="store">Preview</h3></button>
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Publish {{$type->title}}</h3></button>
      </div>
    </div>
    <div class="row">
      <div class="tab active" data-expand="basic">Basic</div><div class="tab" data-expand="advanced">Advanced</div>
    </div>

    <div class="expand-tab basic active" id="basic">

    <div class="row">

      <div class="six columns">
        <p><br>
        <input type="text" name="title" placeholder="title" value="{{$content->title}}" required>
        <input type="text" name="slug" readonly value="{{$content->slug}}"></p>
        <p class="mini">Note that all slugs update automatically with their corresponding titles</p>

        <p>&nbsp;</p>
        <p>Featured Image
        <input type="file" name="featimage" id="images"></p>
      @if($type->time=='1')
        <p>Start Date
        <input type="date" name="start_date" value="{{date('Y-m-d',$content->start_date)}}"></p>
        <p>End Date
        <input type="date" name="end_date" value="{{date('Y-m-d',$content->end_date)}}"></p>
      @endif
      @if($type->categories=='1')
        <p class="round-button" id="category-select">Select Categories</p>
        <div class="modal-backdrop" id="category-selection">
          <div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
            <div class="categories">
              @foreach($categories as $cat)
                <div class="cat">
                  <p>{{$cat->title}}</p>
                  <label class="switch"><input type="checkbox" name="categories[]" value="{{$cat->slug}}" @if($content->categories->contains($cat->id)) checked @endif><span class="slider round"></span></label>
                </div>
              @endforeach
            </div>
        </div>
        <p>&nbsp;</p>
      @endif
        @foreach($type->custom_fields as $custom)
          @if($custom->input == 'textbox')
            <p>{{$custom->name}}</p>
            <div class="transfer" id="customfield{{$custom->id}}">
              <div class="textarea active" contenteditable="true"></div>
              <textarea name="customfield{{$custom->id}}" class="codearea">@if($content->get_the($custom->name)!=''){{$content->get_the($custom->name)}}@else Enter {{$custom->name}} @endif</textarea>
            </div>
            <script>
            $(document).ready(function(){
              $('#customfield{{$custom->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$content->get_the($custom->name))!!}');
            });
            </script>

          @elseif($custom->input == 'checkbox')
              <p>{{$custom->name}}
              <p class="outside-link"><label class="switch"><input type="{{$custom->input}}" name="customfield{{$custom->id}}" @if($content->get_the($custom->name) == 'on')checked @endif value="on"><span class="slider round"></span></label></p>
          @else
            <p>{{$custom->name}}
            <input type="{{$custom->input}}" name="customfield{{$custom->id}}" value="{{$content->get_the($custom->name)}}"></p>
          @endif
        @endforeach
      </div>

      <div class="six columns box">
        <output id="image"><img src="{{$content->featimg()}}"></output>
      </div>

    </div>
    <div id="linker" title="Enter Link URL"><input id="url" type="text" value=""><div class="outside-link">Outside link?<br><label class="switch"><input type="checkbox" id="target" value="_blank"><span class="slider round"></span></label></div><p id="error">Highlight what you want to link and click insert</p><input type="button" onclick="link()" value="Insert"></div>
    @if($type->editor=='1')
    <div class="row">
      <div class="twelve columns">
        <div class="row-editor input_fields_wrap" id="sortable">
          <div id="counter"><input type="hidden" value="" name="order" id="order"></div>

          @php $count=0; $columncount = 0;@endphp
          @foreach($content->rows->sortBy('order') as $row)
            @php $count++; @endphp
            @if($row->order == $count)
          <div class="row content-write" data-id="{{$row->id}}">
              <div class="content-bar">
                <span>Columns<input type="number" name="columns[]" value="{{$row->columns}}" min="1" max="5" class="column-select" id="row{{$row->id}}"></span>

                <span><i class="fa fa-header" aria-hidden="true" style="font-size:22px;" onmousedown="h1()"></i>
                  <i class="fa fa-header" aria-hidden="true" style="font-size:18px;" onmousedown="h2()"></i>
                  <i class="fa fa-header" aria-hidden="true" style="font-size:14px;" onmousedown="h3()"></i>
                  <i class="fa fa-header" aria-hidden="true" style="font-size:8px;" onmousedown="h4()"></i>
                </span>
                <span><i class="fa fa-bold" aria-hidden="true" onmousedown="bold()"></i>
                <i class="fa fa-italic" aria-hidden="true" onmousedown="italic()"></i></span>

                <span><i class="fa fa-align-left" aria-hidden="true" onmousedown="left()"></i>
                <i class="fa fa-align-center" aria-hidden="true" onmousedown="center()"></i>
                <i class="fa fa-align-right" aria-hidden="true" onmousedown="right()"></i></span>


                <i class="fa fa-list" aria-hidden="true" onmousedown="lister()"></i>

                <i class="fa fa-picture-o" aria-hidden="true" onclick="activate(30000)"></i>

                <i class="fa fa-link linker" aria-hidden="true"></i>

                <i class="fa fa-code" aria-hidden="true" onclick="codeview()"></i>

                <input type="number" name="row[]" hidden value="{{$row->id}}">
              </div>
            <i class="fa fa-minus-circle remove_field"></i>
            <i class="fa fa-arrows-v" aria-hidden="true"></i>
            <div class="row{{$row->id}}">
                  @include("dashboard.partials.row-edit")
            </div>
          </div>
          @else
            @while($row->order != $count)
            @foreach($content->components->where('order', $count) as $component)
              @if($component->columns == 'twelve'|| $component->columns == 'eight')
                @php $expected = 1; @endphp
              @elseif($component->columns == 'ten')
                @php $expected = 1; @endphp
              @elseif($component->columns == 'six')
                @php $expected = 2; @endphp
              @elseif($component->columns == 'four')
                @php $expected = 3; @endphp
              @elseif($component->columns == 'three')
                @php $expected = 4; @endphp
              @endif
              @if($columncount == 0)
                @php $closed = false; $columncount++; @endphp
              @endif


              <div class="component-write wrap-right {{$component->columns}} columns" id="component-row{{$component->id}}" data-id="{{$component->id}}"
                @if($columncount==$expected)
                  style="clear:both"
                  <?php $closed = true; $columncount = 0; ?>
                @endif
              >
                <div class="content-bar">
                  <span>{{$component->title}}<i class="fa fa-pencil" aria-hidden="true"></i></span>
                </div>
                <input type="hidden" value="{{$component->slug}}" name="component-slug[]">
                <input type="hidden" value="{{$component->id}}" name="component-id[]">
                <div class="form-backdrop">
                  <div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
                  <div class="forms active">
                    @if($component->slug == 'carousal')
                        @include("dashboard.components.form")
                        @foreach($component->images as $image)
                          <div><img src="{{$image->thumbnail}}"><i class="fa fa-minus-circle delete_carousalimage" data-id="{{$image->id}}" aria-hidden="true"></i></div>
                        @endforeach
                        <div class="input_carousal_wrap">
                          <div class="carousalimage">Insert Carousal Images<input type="file" name="carousalimages[]"><i class="fa fa-minus-circle remove_carousalimage"></i></div>
                        </div>
                        <div class="add_carousal fa fa-plus-circle">Add Another Image</div>
                    @else
                        @include("dashboard.components.form")
                    @endif
                  </div>
                </div>
                <div class="preview active">
                  @include("dashboard.components.preview-".$component->slug)
                </div>
                <i class="fa fa-minus-circle remove_field"></i>
                <i class="fa fa-arrows-v" aria-hidden="true"></i>

                <script>
                $(document).ready(function(){
                  $('#component-row{{$component->id}}').find("input[name='input1[]']").val('{!!str_replace("'",'&#39;',$component->content1)!!}');
                  $('#component-row{{$component->id}}').find("input[name='input2[]']").val('{!!str_replace("'",'&#39;',$component->content2)!!}');
                  $('#component-row{{$component->id}}').find("input[name='input3[]']").val('{!!str_replace("'",'&#39;',$component->content3)!!}');
                  $('#component-row{{$component->id}}').find("input[name='input4[]']").val('{!!str_replace("'",'&#39;',$component->content4)!!}');
                  $('#component-row{{$component->id}}').find("input[name='input5[]']").val('{!!str_replace("'",'&#39;',$component->content5)!!}');
                  @if(substr($component->input1, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content1)!!}');
                  @endif
                  @if(substr($component->input2, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content2)!!}');
                  @endif
                  @if(substr($component->input3, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content3)!!}');
                  @endif
                  @if(substr($component->input4, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content4)!!}');
                  @endif
                  @if(substr($component->input5, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content5)!!}');
                  @endif
                  @if(substr($component->input6, 0, 25)  == '<div class="content-bar">')
                    $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content6)!!}');
                  @endif
                });
                </script>


              </div>

              @php $count++; @endphp
              @if($row->order == $count)
              <div class="row content-write" data-id="{{$row->id}}">
                <div class="content-bar">
                  <span>Columns<input type="number" name="columns[]" value="{{$row->columns}}" min="1" max="5" class="column-select" id="row{{$row->id}}"></span>

                  <span><i class="fa fa-header" aria-hidden="true" style="font-size:22px;" onmousedown="h1()"></i>
                    <i class="fa fa-header" aria-hidden="true" style="font-size:18px;" onmousedown="h2()"></i>
                    <i class="fa fa-header" aria-hidden="true" style="font-size:14px;" onmousedown="h3()"></i>
                    <i class="fa fa-header" aria-hidden="true" style="font-size:8px;" onmousedown="h4()"></i>
                  </span>
                  <span><i class="fa fa-bold" aria-hidden="true" onmousedown="bold()"></i>
                  <i class="fa fa-italic" aria-hidden="true" onmousedown="italic()"></i></span>

                  <span><i class="fa fa-align-left" aria-hidden="true" onmousedown="left()"></i>
                  <i class="fa fa-align-center" aria-hidden="true" onmousedown="center()"></i>
                  <i class="fa fa-align-right" aria-hidden="true" onmousedown="right()"></i></span>


                  <i class="fa fa-list" aria-hidden="true" onmousedown="lister()"></i>

                  <i class="fa fa-picture-o" aria-hidden="true" onclick="activate(30000)"></i>

                  <i class="fa fa-link linker" aria-hidden="true"></i>

                  <i class="fa fa-code" aria-hidden="true" onclick="codeview()"></i>

                  <input type="number" name="row[]" hidden value="{{$row->id}}">
                </div>
                <i class="fa fa-minus-circle remove_field"></i>
                <i class="fa fa-arrows-v" aria-hidden="true"></i>
                <div class="row{{$row->id}}">
                    @include("dashboard.partials.row-edit")
                </div>
              </div>
              @endif
            @endforeach
            @endwhile
          @endif
        @endforeach
        @php $columncount = 0;@endphp
        @foreach($content->components->where('order', '>', $count) as $component)
            @if($component->columns == 'twelve'|| $component->columns == 'eight')
              @php $expected = 1; @endphp
            @elseif($component->columns == 'six')
              @php $expected = 2; @endphp
            @elseif($component->columns == 'four')
              @php $expected = 3; @endphp
            @elseif($component->columns == 'three')
              @php $expected = 4; @endphp
            @endif







          <div class="component-write wrap-right {{$component->columns}} columns" id="component-row{{$component->id}}" data-id="{{$component->id}}"
          @if($columncount==$expected)
            style="clear:both;"
            <?php $columncount = 0;$columncount++; ?>
          @else
            <?php $columncount++; ?>
          @endif>
            <div class="content-bar">
              <span>{{$component->title}}<i class="fa fa-pencil" aria-hidden="true"></i></span>
            </div>
            <input type="hidden" value="{{$component->slug}}" name="component-slug[]">
            <input type="hidden" value="{{$component->id}}" name="component-id[]">
            <div class="form-backdrop">
              <div class="x"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
              <div class="forms active">
                @if($component->slug == 'carousal')
                    @include("dashboard.components.form")
                    @foreach($component->images as $image)
                      <div><img src="{{$image->thumbnail}}"><i class="fa fa-minus-circle delete_carousalimage" data-id="{{$image->id}}" aria-hidden="true"></i></div>
                    @endforeach
                    <div class="input_carousal_wrap">
                      <div class="carousalimage">Insert Carousal Images<input type="file" name="carousalimages[]"><i class="fa fa-minus-circle remove_carousalimage"></i></div>
                    </div>
                    <div class="add_carousal fa fa-plus-circle">Add Another Image</div>
                @else
                    @include("dashboard.components.form")
                @endif
              </div>
            </div>
            <div class="preview active">
              @include("dashboard.components.preview-".$component->slug)
            </div>
            <i class="fa fa-minus-circle remove_field"></i>
            <i class="fa fa-arrows-v" aria-hidden="true"></i>

            <script>
            $(document).ready(function(){

              $('#component-row{{$component->id}}').find("input[name='input1[]']").val('{!!str_replace("'",'&#39;',$component->content1)!!}');
              $('#component-row{{$component->id}}').find("input[name='input2[]']").val('{!!str_replace("'",'&#39;',$component->content2)!!}');
              $('#component-row{{$component->id}}').find("input[name='input3[]']").val('{!!str_replace("'",'&#39;',$component->content3)!!}');
              $('#component-row{{$component->id}}').find("input[name='input4[]']").val('{!!str_replace("'",'&#39;',$component->content4)!!}');
              $('#component-row{{$component->id}}').find("input[name='input5[]']").val('{!!str_replace("'",'&#39;',$component->content5)!!}');
              @if(substr($component->input1, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content1)!!}');
              @endif
              @if(substr($component->input2, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content2)!!}');
              @endif
              @if(substr($component->input3, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content3)!!}');
              @endif
              @if(substr($component->input4, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content4)!!}');
              @endif
              @if(substr($component->input5, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content5)!!}');
              @endif
              @if(substr($component->input6, 0, 25)  == '<div class="content-bar">')
                $('#component-row{{$component->id}}').find(".textarea").html('{!!str_replace("'",'&#39;',$component->content6)!!}');
              @endif

            });
            </script>

          </div>

        @endforeach


        </div>

        <div class="more fa fa-plus-circle"></div>
      </div>
    </div>
    @endif

  </div>
  <div class="expand-tab advanced" id="advanced">
    <div class="row">
      <div class="six columns">
        <p>Meta Keywords (separate with commas) &nbsp; <span class="tiny" id="keywordcounter"></span>
        <input type="text" name="keywords" value="{{$content->keywords}}" id="keywords"></p>
        <p>&nbsp;</p>
        <p>Meta Description &nbsp; <span class="tiny" id="metacounter"></span>
        <input type="text" name="metadesc" value="{{$content->metadesc}}" id="meta"></p>
        <p>&nbsp;</p>
      </div>
      <div class="six columns">
        <p class="select-box">Select Template
          <select name="template">
            <option value="{{$type->templates->first()->id}}">Default {{$type->title}} Template</option>
            @foreach($templates as $template)
              <option value="{{$template->id}}" @if(isset($content->template->slug) && $template->slug == $content->template->slug) selected @endif>{{$template->title}}</option>
            @endforeach
          </select>
        <i class="fa fa-sort-desc" aria-hidden="true"></i></p>
      </div>
    </div>

  </div>


  </form>

  @push('footer')

@include('dashboard.partials.contentoptions')
    <script>
    //order functions for saving
$(document).on('mouseover', '.store', function(){
      var ids = [];


      $('#counter').siblings().each(function () {
       ids.push($(this).data('id'));
      });
      ids.join(',');
      $('#order').val(ids);

});

$('#contentsubmission').submit( function(event) {
        form = this;
        $('.message').css('top','0px');
        var ids = [];


        $('#counter').siblings().each(function () {
         ids.push($(this).data('id'));
        });
        ids.join(',');
        $('#order').val(ids);

    event.preventDefault();

    setTimeout( function () {
        form.submit();
    }, 500);
});

    </script>
    @include('dashboard.functions.scrubber')
    @include('dashboard.functions.meta')
    @include('dashboard.functions.prevent')
    @include('dashboard.functions.basic')
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