<div class="row content-item">
    <div class="two push_one columns">
      @isset($content->type)
        <a href="/{{$content->type->slug}}/{{$content->slug}}" target="_blank">
      @endisset
          <p><name data-unix="{{strtotime($content->updated_at)}}">{{$content->title}}</name></p>
      @isset($content->type)
        </a>
      @endisset
    </div>
    <div class="two columns">
      <p>{{date('M j, Y',strtotime($content->updated_at))}}</p>
    </div>
    <div class="two columns">
      @isset($content->published)
        @if($content->published == 1)
          <p class="published" data-id="{{$content->id}}"><i class="fa fa-check" aria-hidden="true"></i></p>
        @else
          <p class="published" data-id="{{$content->id}}"><i class="fa fa-times" aria-hidden="true"></i></p>
        @endif
      @endisset
    </div>
    <div class="two push_one columns">
      @isset($content->type)
        <a href="/dashboard/{{$type->id}}/{{$content->id}}/edit" class="edit-link"><p class="edit">Edit</p></a>
      @else
        <a href="/dashboard/{{$type->slug}}/{{$content->id}}/edit" class="edit-link"><p class="edit">Edit</p></a>
      @endif
    </div>
    <div class="two columns">
      @isset($deleted)
      @else
        @isset($content->type)
          <p class="delete" data-id="{{$content->id}}">Delete</p>
        @else
          <a href="/dashboard/{{$type->slug}}/{{$content->id}}/delete"><p class="delete">Delete</p></a>
        @endif
      @endisset
    </div>
</div>
