<div class="{{$component->columns}} columns carousal ">
  @if(isset($component->images))
    @foreach($component->images as $image)
      <div><img src="{{$image->thumbnail}}"></div>
    @endforeach
  @endif
    <a @isset($component->content1)href="{{$component->content1}}" @if($component->outside == 'on')target="_blank" onclick="trackOutboundLink('{{$component->content1}}'); return false;" @endif @endisset><div><img src="@if(isset($component->image)){{$component->image}}@else/additional/placeholder.jpg @endif"><div class="caption">View More<i class="fa fa-angle-right" aria-hidden="true"></i></div></div></a>
</div>

<link rel="stylesheet" type="text/css" href="/slick/slick.css">
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
<script type="text/javascript" src="/slick/slick.min.js"></script>
<script>
$('.carousal').slick({
  dots: true,
});
</script>
