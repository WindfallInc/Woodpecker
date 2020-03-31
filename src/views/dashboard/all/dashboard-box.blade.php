
<div class="row">
  <div class="ten push_one columns strip">
    <h1 class="-brown">{{str_plural($content_type)}}</h1>
  </div>
</div>
<div class="dashboard-box row">

  <div class="box-header row">
    <div class="two columns push_one name-sorting">
      <i class="fas fa-sort-alpha-down" id="reversealphBnt"></i>
      <i class="fas fa-sort-alpha-up-alt" id="alphBnt"></i>
      <input type="text" placeholder="Search {{str_plural($content_type)}}..." id="SearchInput" onkeyup="searchFunction()">
    </div>

    <div class="two columns date-sorting">
      @if($type_id != '0')
      <i class="far fa-calendar-alt"></i>
      <i class="fas fa-arrow-up" id="unixSort"></i>
      <i class="fas fa-arrow-down" id="revunixSort"></i>
      @endif
    </div>


    <div class="two columns published-sorting">
      @if($type_id != '0')
      <i class="far fa-eye" id="allpublishsort"></i>
      <i class="fas fa-check" id="publishsort"></i>
      <i class="fas fa-times" id="unpublishsort"></i>
      @endif
    </div>

    <a class="two push_three columns new" href="/dashboard/@if($type_id != '0'){{$type_id}}@else{{strtolower($content_type)}}@endif/create">
      <i class="fas fa-plus"></i>
    </a>
  </div>
  <div class="dashboard-list">
    <div class="list_zone" id="list_zone">
      {{$list_zone}}
    </div>
  </div>
  @isset($deleted)
    <a href="/dashboard/{{$type_id}}/all" class="deleted">View {{str_plural($content_type)}}</a>
  @else
  <a href="/dashboard/{{$type_id}}/deleted" class="deleted">View Deleted {{str_plural($content_type)}}</a>
  @endif
</div>