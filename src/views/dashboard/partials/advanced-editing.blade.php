<div class="expand-tab advanced" id="advanced">
  <div class="row -padding">
    <div class="six columns">
      <p>Meta Keywords (separate with commas) &nbsp; <span class="tiny" id="keywordcounter"></span>
      <input type="text" name="keywords" @isset($content->keywords)value="{{$content->keywords}}" @endisset id="keywords"></p>
      <p>&nbsp;</p>
      <p>Meta Description &nbsp; <span class="tiny" id="metacounter"></span>
      <input type="text" name="metadesc" @isset($content->metadesc) value="{{$content->metadesc}}" @endisset id="meta"></p>
      <p>&nbsp;</p>
    </div>
    <div class="six columns">
      <p class="select-box">Select Template
        <select name="template">
          @isset($type->templates->first()->id)
            <option value="{{$type->templates->first()->id}}">Default {{$type->title}} Template</option>
          @else
            <option>- Using Default {{$type->title}} Template -</option>
          @endisset

          @foreach($templates as $template)
            <option value="{{$template->id}}" @if(isset($content->template->slug) && $template->slug == $content->template->slug) selected @endif>{{$template->title}}</option>
          @endforeach
        </select>
      <i class="fa fa-sort-desc" aria-hidden="true"></i></p>
    </div>
  </div>
</div>