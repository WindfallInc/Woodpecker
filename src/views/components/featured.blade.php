<div class="{{$component->columns}} columns featured">
		<img src="@if(isset($component->image)){{$component->image}}@else/additional/placeholder.jpg @endif" width="100%" style="display:flex; margin:auto; height:142px; object-fit:cover;">
			<h4>@isset($component->content1){!!$component->content1!!}@endisset</h4>
			<h5>@isset($component->content2){!!$component->content2!!}@endisset</h5>
			<p>@isset($component->content3){!!$component->content3!!}@endisset</p>

		<div class="partner-more-btn">
			<a href="@isset($component->content4){{$component->content4}}@endisset" @if($component->outside == 'on')target="_blank" onclick="trackOutboundLink('{{$component->content1}}'); return false;" @endif >@if(isset($component->content5)){{$component->content5}}@else Learn More @endif</a>
		</div>
</div>
