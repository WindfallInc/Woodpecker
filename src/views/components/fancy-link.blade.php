<div class="{{$component->columns}} columns fancy-link">
<a href="@isset($component->content1){{$component->content1}}@endisset" @if($component->outside == 'on')target="_blank" @endif class="cta">@if(isset($component->content2)){{$component->content2}}@else Example Link @endif</a>
</div>