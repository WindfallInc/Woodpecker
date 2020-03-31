<div class="expand-tab basic active" id="basic">
<div class="row -padding">

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