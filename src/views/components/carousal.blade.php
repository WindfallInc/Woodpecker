<div class="{{$component->columns}} columns carousal ">
  @if(isset($component->images))
    @foreach($component->images as $image)
      <div><img src="{{$image->thumbnail}}"></div>
    @endforeach
  @else
    <img src="/assets/component/carousal-component.jpg" alt="">
  @endif
  @if($component->template == 1)

  @elseif(isset($component->content1))
    <a href="{{$component->content1}}" @if($component->outside == 'on')target="_blank"@endif>
  @endif
  <div>
    <img src="@if(isset($component->image)){{$component->image}}@else/additional/placeholder.jpg @endif">
    @isset($component->content1)
      <div class="caption">View More<i class="fa fa-angle-right" aria-hidden="true"></i></div>
    @endisset
  </div>
  @if($component->template == 1)

  @elseif(isset($component->content1))
    </a>
  @endisset
</div>

<link rel="stylesheet" type="text/css" href="/slick/slick.css">
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css">
<script type="text/javascript" src="/slick/slick.min.js"></script>
<script>
$('.carousal').slick({
  dots: true,
  autoplay: true,
  autoplaySpeed: 2000,
});
</script>