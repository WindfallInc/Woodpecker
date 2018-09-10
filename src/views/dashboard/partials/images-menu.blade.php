<div class="components-nav" id="30000">
  <i class="fa fa-times" aria-hidden="true" onclick="activate(30000)"></i>
  <h1 class="box">Images</h1>
  <ul>
  @if(isset($content->images))
  @foreach($content->images as $media)
    <li id="addimage{{$media->id}}"><img src="{{$media->path}}" class="media-img" data-id="{{$media->id}}"></li>
  @endforeach
  @endif
  @if(isset($content->category))
  @foreach($content->category->media as $media)
    <li id=""><img src="{{$media->path}}"></li>
  @endforeach
  @endif
  <p><strong>Additional Images</strong>
    <div class="input_images_wrap">
      <div class="image">
      <input type="file" name="additionalimages[]" class="additional-image-selector">

      </div>
    </div>
    </p>
    <li id=""><output id="additionalimage"></output></li>
  </ul>
</div>
