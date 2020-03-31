<div class="{{$component->columns}} columns featured">
		<img src="@if(isset($component->image)){{$component->image}}@else/additional/placeholder.jpg @endif" width="100%" style="display:flex; margin:auto; height:142px; object-fit:cover;">
			<h4>@if($component->template == 1) Example Content @else{!!$component->content1!!}@endif</h4>
			<h5>@if($component->template == 1) Example Content @else{!!$component->content2!!}@endif</h5>
			<p>@if($component->template == 1) Example Content @else{!!$component->content3!!}@endif</p>

		<div class="partner-more-btn">
			<a href="@isset($component->content4){{$component->content4}}@endisset" @if($component->outside == 'on')target="_blank" @endif >@if($component->template == 1) Learn More @elseif(isset($component->content5)){{$component->content5}}@else Learn More @endif</a>
		</div>
</div>