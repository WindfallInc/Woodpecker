@if($row->columns == 1)
  @php
    $regex = '/<div class=\"twelve columns">(.*?)<\/div>/s';
    preg_match_all($regex, $row->content, $matches);
  @endphp
  <div class="twelve columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][0]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][0]}}</textarea>
  </div>
@endif
@if($row->columns == 2)
  @php
    $regex = '/<div class=\"six columns">(.*?)<\/div>/s';
    preg_match_all($regex, $row->content, $matches);
  @endphp
  <div class="six columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][0]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][0]}}</textarea>
  </div>
  <div class="six columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][1]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][1]}}</textarea>
  </div>
@endif
@if($row->columns == 3)
  @php
    $regex = '/<div class=\"four columns">(.*?)<\/div>/s';
    preg_match_all($regex, $row->content, $matches);
  @endphp
  <div class="four columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][0]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][0]}}</textarea>
  </div>
  <div class="four columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][1]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][1]}}</textarea>
  </div><div class="four columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][2]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][2]}}</textarea>
  </div>
@endif
@if($row->columns == 4)
  @php
    $regex = '/<div class=\"three columns">(.*?)<\/div>/s';
    preg_match_all($regex, $row->content, $matches);
  @endphp
  <div class="three columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][0]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][0]}}</textarea>
  </div>
  <div class="three columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][1]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][1]}}</textarea>
  </div>
  <div class="three columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][2]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][2]}}</textarea>
  </div>
  <div class="three columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][3]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][3]}}</textarea>
  </div>
@endif
@if($row->columns == 5)
  @php
    $regex = '/<div class=\"two columns">(.*?)<\/div>/s';
    preg_match_all($regex, $row->content, $matches);
  @endphp
  <div class="two columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][0]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][0]}}</textarea>
  </div>
  <div class="two columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][1]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][1]}}</textarea>
  </div>
  <div class="two columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][2]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][2]}}</textarea>
  </div>
  <div class="two columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][3]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][3]}}</textarea>
  </div>
  <div class="two columns transfer">
    <div class="textarea active" contenteditable="true" >{!!$matches[1][4]!!}</div>
    <textarea name="column[]" class="codearea">{{$matches[1][4]}}</textarea>
  </div>
@endif
