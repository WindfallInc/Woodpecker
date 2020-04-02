@extends('dashboard.layout.dashboard')

@section('content')
  @push('header')

  <style type="text/css">
  a,a:visited {
    color: #4183C4;
    text-decoration: none;
  }
  pre,code {
    font-size: 12px;
  }
  pre {
    width: 100%;
    overflow: auto;
  }
  small {
    font-size: 90%;
  }
  small code {
    font-size: 11px;
  }
  .placeholder {
    outline: 1px dashed #4183C4;
  }
  .mjs-nestedSortable-error {
    background: #fbe3e4;
    border-color: transparent;
  }
  #tree {
    width: 550px;
    margin: 0;
  }
  ol {
    max-width: 450px;
    padding-left: 25px;
  }
  ol.sortable,ol.sortable ol {
    list-style-type: none;
  }
  .sortable li div {
    border: 1px solid #d4d4d4;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    cursor: move;
    border-color: #D4D4D4 #D4D4D4 #BCBCBC;
    margin: 0;
    padding: 3px;
  }
  li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
    border-color: #999;
  }
  .disclose, .expandEditor {
    cursor: pointer;
    width: 20px;
    display: none;
  }
  .sortable li.mjs-nestedSortable-collapsed > ol {
    display: none;
  }
  .sortable li.mjs-nestedSortable-branch > div > .disclose {
    display: inline-block;
  }
  .sortable span.ui-icon {
    display: inline-block;
    margin: 0;
    padding: 0;
  }
  .menuDiv {
    background: #EBEBEB;
  }
  .menuEdit {
    background: #FFF;
  }
  .itemTitle {
    vertical-align: middle;
    cursor: pointer;
  }
  .deleteMenu {
    float: right;
    cursor: pointer;
  }
  p,ol,ul,pre,form {
    margin-top: 0;
    margin-bottom: 1em;
  }
  dl {
    margin: 0;
  }
  dd {
    margin: 0;
    padding: 0 0 0 1.5em;
  }
  code {
    background: #e5e5e5;
  }
  .notice {
    color: #c33;
  }
  </style>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/jquery.mjs.nestedSortable.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush


    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">{{$menu->title}}</h1>
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
            <ol class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded navs_wrap" id="menu">

              @if(count($menu->parents())>0)
                @foreach($menu->parents() as $nav)
                  <li class="mjs-nestedSortable-branch mjs-nestedSortable-expanded" id="menuItem_{{$nav->id}}">
                    <div class="menuDiv">
                      @if(count($nav->children())>0)
                      <span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick">
                      <span></span>
                      </span>
                      @endif
                      <span title="Click to show/hide item editor" data-id="{{$nav->id}}" class="expandEditor ui-icon ui-icon-triangle-1-n">
                      <span></span>
                      </span>
                      <span>
                      <span data-id="{{$nav->id}}" class="itemTitle">{{$nav->title}}</span>
                      <span title="Click to delete item." data-id="{{$nav->id}}" class="deleteMenu ui-icon ui-icon-closethick">
                      <span></span>
                      </span>
                      </span>
                      <div id="menuEdit{{$nav->id}}" class="menuEdit hidden" style="display:none;">
                        <p>Leads to: <span class="url">{{$nav->url}}</span></p>
                        <p>Target: <span class="target">{{$nav->target}}</span></p>
                      </div>
                    </div>
                    @if(count($nav->children())>0)
                      <ol class="children">
                    @foreach($nav->children() as $child)

                        <li class="mjs-nestedSortable-branch mjs-nestedSortable-expanded" id="menuItem_{{$child->id}}" data-foo="baz">
                        <div class="menuDiv">
                          @if(count($child->children())>0)
                          <span title="Click to show/hide children" class="disclose ui-icon ui-icon-minusthick">
                          <span></span>
                          </span>
                          @endif
                          <span title="Click to show/hide item editor" data-id="{{$child->id}}" class="expandEditor ui-icon ui-icon-triangle-1-n">
                          <span></span>
                          </span>
                          <span>
                          <span data-id="{{$child->id}}" class="itemTitle">{{$child->title}}</span>
                          <span title="Click to delete item." data-id="{{$child->id}}" class="deleteMenu ui-icon ui-icon-closethick">
                          <span></span>
                          </span>
                          </span>
                          <div id="menuEdit{{$child->id}}" class="menuEdit hidden" style="display:none;">
                            <p>Leads to: <span class="url">{{$child->url}}</span></p>
                            <p>Target: <span class="target">{{$child->target}}</span></p>
                          </div>
                        </div>
                        @if(count($child->children())>0)
                          <ol class="children">
                        @foreach($child->children() as $subchild)

                            <li class="mjs-nestedSortable-leaf" id="menuItem_{{$subchild->id}}">
                            <div class="menuDiv">
                              <span title="Click to show/hide item editor" data-id="{{$subchild->id}}" class="expandEditor ui-icon ui-icon-triangle-1-n">
                              <span></span>
                              </span>
                              <span>
                              <span data-id="{{$subchild->id}}" class="itemTitle">{{$subchild->title}}</span>
                              <span title="Click to delete item." data-id="{{$subchild->id}}" class="deleteMenu ui-icon ui-icon-closethick">
                              <span></span>
                              </span>
                              </span>
                              <div id="menuEdit{{$subchild->id}}" class="menuEdit hidden" style="display:none;">
                                <p>Leads to: <span class="url">{{$subchild->url}}</span></p>
                                <p>Target: <span class="target">{{$subchild->target}}</span></p>
                              </div>
                            </div>
                            </li>
                        @endforeach
                          </ol>
                        @endif
                      </li>
                    @endforeach
                      </ol>
                  @endif
                </li>
                @endforeach
              @endif

            </ol>




            </div>
            <div class="five columns">
              <h3>New Nav Item</h3>
              <p><input type="text" name="title" placeholder="Title" id="title" required></p>
              <p><input type="text" name="url" list="urls" placeholder="url" id="url" required></p>
              <datalist id="urls">
                @foreach($types as $type)
                  @foreach($type->contents as $content)
                    <option value="/{{$content->slug}}">
                  @endforeach
                @endforeach
              </datalist>
              <p>Outside Link<input type="checkbox" name="title" value='_blank' id="type"><span class="mini">Checking this option will make this item open in another tab</span></p>
              <p class="create add_nav">ADD ITEM</p>
            </div>
          </div>
        </div>
      </div>
    </div>


{{--</form>--}}







    @push('footer')
      <script>
      $(document).ready(function() {
        var max_fields      = 69; //maximum additions allowed
        var wrapper         = $(".navs_wrap"); //Fields wrapper
        var add_nav         = $(".add_nav"); //Add button ID
        var id              = {{$newid}};


        var x = 0; //initlal text box count
        $(add_nav).click(function(e){ //on add input button click
          var title           = $("#title").val();
          var url             = $("#url").val();
          if($("#type").is(":checked")){
            var target        = $("#type").val();
          }
          else{
            var target        ="_self";
          }
            id++;
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<li class="mjs-nestedSortable-branch mjs-nestedSortable-expanded" id="menuItem_'+id+'"> <div class="menuDiv"> <span title="Click to show/hide item editor" data-id="'+id+'" class="expandEditor ui-icon ui-icon-triangle-1-n"> <span></span> </span> <span> <span data-id="'+id+'" class="itemTitle">'+title+'</span> <span title="Click to delete item." data-id="'+id+'" class="deleteMenu ui-icon ui-icon-closethick"> <span></span> </span> </span> <div id="menuEdit'+id+'" class="menuEdit hidden"> <p>Leads to: <span class="url">'+url+'</span></p> <p>Target: <span class="target">'+target+'</span></p> </div> </div> </li>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            $(this).parent('div').remove();
        });
      });
      </script>
      <script>
$(document).on('click', '.store', function(e){

    $('.notification').css('top', 0);


    var out = [];

    function processOneLi(node) {

        var aNode = node.children(".menuDiv");
        var retVal = {
            "title": aNode.find(".itemTitle").text(),
            "url": aNode.find(".url").text(),
            "target": aNode.find(".target").text(),
            "id": aNode.find(".itemTitle").data("id")
        };

        node.find("> ol > li").each(function() {
            if (!retVal.hasOwnProperty("children")) {
                retVal.children = [];
            }
            retVal.children.push(processOneLi($(this)));
        });

        return retVal;
    }

    $("#menu").children("li").each(function() {
        out.push(processOneLi($(this)));
    });


    console.log("got the following JSON from your HTML:", JSON.stringify(out));
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        type: 'POST',
        url:'/dashboard/menu/{{$menu->id}}/update',
        dataType:"json",
        data: {out},
        success: function(response){
            console.log("returned : " + typeof(response));

            return true;
        }
    });

    setTimeout(function(){
      $('.notification').addClass('active');
    }, 2000);
    setTimeout(function(){
      $('.notification').text('Saved');
    }, 6000);
    setTimeout(function(){
      $('.notification').css('top','-150px');
    }, 9000);


});
      </script>
      <script>
        $().ready(function(){
          var ns = $('ol.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper:	'clone',
            items: 'li',
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            maxLevels: 3,
            startCollapsed: true,
            isTree: true,
            expandOnHover: 700,

            change: function(){
              console.log('Relocated item');
            }
          });

          $('.expandEditor').attr('title','Click to show/hide item editor');
          $('.disclose').attr('title','Click to show/hide children');
          $('.deleteMenu').attr('title', 'Click to delete item.');


          $('.disclose').on('click', function() {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
          });

          $(document).on('click', '.expandEditor, .itemTitle', function(e){
            var id = $(this).attr('data-id');
            $('#menuEdit'+id).toggle();
            $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
          });

          $(document).on('click', '.deleteMenu', function(e){
            var id = $(this).attr('data-id');
            $('#menuItem_'+id).remove();
          });

        });
      </script>
    @endpush

@endsection
