@extends('dashboard.layout.dashboard')

@section('content')

@push('header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

    <div class="message" style="position:fixed; top:-150px; background-color:#F18F01; left:0px; padding:20px; color:#fff; transition:linear all .2s; width:100vw; text-align:center;">
      <p>LOADING...</p>
    </div>

    <div class="row heading">
      <div class="four columns">
        <h3>{{str_plural($type->title)}}<i class="fa fa-angle-up" aria-hidden="true" id="alphBnt"></i><i class="fa fa-angle-down" aria-hidden="true" id="reversealphBnt"></i></h3>
      </div>
      <div class="four columns">
        <h3>Edited<i class="fa fa-angle-up" aria-hidden="true" id="unixSort"></i><i class="fa fa-angle-down" aria-hidden="true" id="revunixSort"></i></h3>
      </div>
      <div class="four columns">
        <a href="/dashboard/{{$type->id}}/create"><h3 class="create">New {{$type->title}}</h3></a>
      </div>
    </div>

    <div class="row searchbar">
      <div class="four columns">
        <input type="text" id="SearchInput" onkeyup="searchFunction()" placeholder="Search {{$type->title}}">
      </div>
      <div class="two columns">

      </div>
      <div class="two columns centering">
        <i class="fa fa-check" aria-hidden="true" id="publishsort"></i><i class="fa fa-times" aria-hidden="true" id="unpublishsort"></i><i class="fa fa-eye active" aria-hidden="true" id="allpublishsort"></i>
      </div>
    </div>

    <div class="row dashboard-list" id="list">
      <hr>
      @if(count($contents)==0)
        <p>No {{str_plural($type->title)}} have been deleted.</p>
      @endif
      @foreach($contents as $content)
        @if($user->canEdit($content->id))
          <span class="content-item">
          <div class="row">
            <div class="three push_one columns">
              <a href="/{{$content->type->slug}}/{{$content->slug}}" target="_blank"><p><thing data-unix="{{strtotime($content->updated_at)}}">{{$content->title}}</thing></p></a>
            </div>
            <div class="two columns">
              <p>{{date('M j, Y',strtotime($content->updated_at))}}</p>
            </div>
            <div class="two columns centering">
              @if($content->published == 1)
                <p class="published" data-id="{{$content->id}}"><i class="fa fa-check" aria-hidden="true"></i></p>
              @else
                <p class="published" data-id="{{$content->id}}"><i class="fa fa-times" aria-hidden="true"></i></p>
              @endif
            </div>
            <div class="two push_two columns">
              <a href="/dashboard/{{$type->id}}/{{$content->id}}/edit" class="edit-link"><p class="edit">Edit</p></a>
            </div>
          </div>
          <hr>
          </span>
        @endif
      @endforeach
      <p><a href="/dashboard/{{$type->id}}/all">View {{str_plural($type->title)}}</a></p>
    </div>

    @push('footer')
      <script>
      $(document).ready(function(){

    $(document).on('click', '.edit-link', function(e){
        $('.message').css('top','0px');
    });

});
      </script>
    <script>
    $(document).on('click', '.published', function(e){
      var postId = $(this).data("id");
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/dashboard/{{$type->slug}}/active/update',
        data: {postId: postId},
      })
      if($(this).html()=='<i class="fa fa-check" aria-hidden="true"></i>'){
        $(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
      }
      else {
        $(this).html('<i class="fa fa-check" aria-hidden="true"></i>');
      }
      $(this).parents('span').css('display','block');
    });
    </script>
    <script>
    $(document).on('click', '.delete', function(e){
      var postId = $(this).data("id");
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/dashboard/{{$type->id}}/delete',
        data: {postId: postId},
      })

      $(this).parents('span').remove();
    });
    </script>
    <script>
    function searchFunction() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById('SearchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("list");
        li = ul.getElementsByTagName('span');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("thing")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    function catFunction() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById('SearchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("list");
        li = ul.getElementsByTagName('span');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("thing")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    $(document).on('click', '#publishsort', function(){
      var ul, li, a, i;
      ul = document.getElementById("list");
      li = ul.getElementsByTagName('span');

      $('.fa-times').removeClass('active');
      $('.fa-eye').removeClass('active');
      $(this).addClass('active');
      for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByClassName("published")[0];
          if (a.innerHTML == '<i class="fa fa-check" aria-hidden="true"></i>') {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";
          }
      }
    });

    $(document).on('click', '#unpublishsort', function(){
      var ul, li, a, i;
      ul = document.getElementById("list");
      li = ul.getElementsByTagName('span');

      $('.fa-check').removeClass('active');
      $('.fa-eye').removeClass('active');
      $(this).addClass('active');
      for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByClassName("published")[0];
          if (a.innerHTML == '<i class="fa fa-times" aria-hidden="true"></i>') {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";
          }
      }
    });

    $(document).on('click', '#allpublishsort', function(){
      var ul, li, a, i;
      ul = document.getElementById("list");
      li = ul.getElementsByTagName('span');

      $('.fa-check').removeClass('active');
      $('.fa-times').removeClass('active');
      $(this).addClass('active');
      for (i = 0; i < li.length; i++) {
          li[i].style.display = "block";
      }
    });




// sort alphabetically
$('#alphBnt').on('click', function () {
  // add selected effect
  $(this).addClass('active');
  $('#reversealphBnt').removeClass('active');
    var $list = $('#list');
    var $listLi = $('span',$list);
    $listLi.sort(SortByName);
    $.each($listLi, function(index, row){
        $list.append(row);
    });
});

// reverse alphabetical order
$('#reversealphBnt').on('click', function () {
  $(this).addClass('active');
  $('#alphBnt').removeClass('active');
  var $list = $('#list');
  var $listLi = $('span',$list);
  $listLi.sort(SortByName);
  $listLi = $listLi.get().reverse();
  $.each($listLi, function(index, row){
      $list.append(row);
  });
});

//This will sort the names we pass it
function SortByName(a, b){
  var aName = $(a).find("thing").text().toLowerCase();
  var bName = $(b).find("thing").text().toLowerCase();
  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
}

var $divs = $("span.content-item");
// sort by unix timestamps
$('#unixSort').on('click', function () {
  $(this).addClass('active');
  $('#revunixSort').removeClass('active');
  var numericallyOrderedDivs = $divs.sort(function (a, b) {
      return $(a).find("thing").data('unix') - $(b).find("thing").data('unix');
  });
  $("#list").html(numericallyOrderedDivs);
  $("#list").prepend( "<hr>" );
});

$('#revunixSort').on('click', function () {
  $(this).addClass('active');
  $('#unixSort').removeClass('active');
  var numericallyOrderedDivs = $divs.sort(function (a, b) {
      return  $(b).find("thing").data('unix')- $(a).find("thing").data('unix');
  });
  $("#list").html(numericallyOrderedDivs);
  $("#list").prepend( "<hr>" );
});


    </script>
    @endpush

@endsection
