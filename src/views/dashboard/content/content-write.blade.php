@extends('dashboard.layout.dashboard')

@section('content')

@push('header')
  <!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
  //<![CDATA[
          bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
  </script> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush
<div class="message" style="position:fixed; top:-150px; background-color:#F18F01; left:0px; padding:20px; color:#fff; transition:linear all .2s; width:100vw; text-align:center;">
  <p>LOADING...</p>
</div>
  <form action="/dashboard/{{$type->id}}/store" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    @include('dashboard.partials.images-menu')


    <div class="row heading">
      <div class="four columns">
        <h3>New {{$type->title}}</h3>
      </div>
      <div class="four columns">
        <button class="nope" onclick='this.form.action="/dashboard/{{$type->id}}/store/draft";'><h3 class="store">Preview</h3></button>
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
        <input type="text" name="title" placeholder="title" required></p>
        <p>&nbsp;</p>


        <p>Featured Image
        <input type="file" name="featimage" id="images"></p>

        @if($type->time=='1')
          <p>Start Date
          <input type="date" name="start_date"></p>
          <p>End Date
          <input type="date" name="end_date"></p>
        @endif

        @if($type->categories=='1')
          @include('dashboard.partials.category-select')
        @endif

        @foreach($type->custom_fields as $custom)
          @if($custom->input == 'textbox')
            <p>{{$custom->name}}</p>
            <div class="transfer custom-field-row" id="customfield{{$custom->id}}">
              <div class="textarea active" contenteditable="true"><p>Enter {{$custom->name}}</p></div>
              <textarea name="customfield{{$custom->id}}" class="codearea"><p>Enter {{$custom->name}}</p></textarea>
            </div>
          @elseif($custom->input == 'checkbox')
              <p>{{$custom->name}}
              <p class="outside-link"><label class="switch"><input type="{{$custom->input}}" name="customfield{{$custom->id}}" value="on"><span class="slider round"></span></label></p>
          @else
            <p>{{$custom->name}}
            <input type="{{$custom->input}}" name="customfield{{$custom->id}}"></p>
          @endif
        @endforeach
      </div>
      <div class="six columns box">
        <output id="image"></output>
      </div>

    </div>


    <div id="linker" title="Enter Link URL"><input id="url" type="text" value=""><div class="outside-link">Outside link?<br><label class="switch"><input type="checkbox" id="target" value="_blank"><span class="slider round"></span></label></div><p id="error">Highlight what you want to link and click insert</p><input type="button" onclick="link()" value="Insert"></div>
    @if($type->editor=='1')
    <div class="row">
      <div class="twelve columns">
        <div class="row-editor input_fields_wrap" id="sortable">
          <div id="counter"><input type="hidden" value="" name="order" id="order"></div>


          <div class="row content-write" data-id="{{$last}}">
              @include("dashboard.partials.content-bar")
            <i class="fa fa-minus-circle remove_field"></i>
            <i class="fa fa-arrows-v" aria-hidden="true"></i>
            <div class="row{{$last}}">
              <div class="twelve columns transfer">
                <div class="textarea active" contenteditable="true" ></div>
                <textarea name="column[]" class="codearea"></textarea>
              </div>
            </div>
          </div>



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
        <input type="text" name="keywords" id="keywords"></p>
        <p>&nbsp;</p>
        <p>Meta Description &nbsp; <span class="tiny" id="metacounter"></span>
        <input type="text" name="metadesc" id="meta"></p>
        <p>&nbsp;</p>
      </div>
      <div class="six columns">
        <p class="select-box">Template
        <select name="template" required>
          <option>- Using Default {{$type->title}} Template -</option>
          @foreach($templates as $template)
            <option value="{{$template->id}}">{{$template->title}}</option>
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
      ids.join(', ');
      $('#order').val(ids);
});

</script>
@include('dashboard.functions.scrubber')
@include('dashboard.functions.meta')
@include('dashboard.functions.prevent')
@include('dashboard.functions.basic')
@include('dashboard.functions.content-bar')
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
