<a class="gallery-large" @isset($component->content1)href="{{$component->content1}}" target="_blank"@endisset>
	<img src="@if(isset($component->image)){{$component->image}}@else/component/placeholder.jpg @endif" alt="{{$component->content2}}">
	<h3>{{$component->content2}}</h3>
</a>