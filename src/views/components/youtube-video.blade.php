<div class="{{$component->columns}} columns youtube-video" style="display: flex;justify-content: center;align-items: center;">
	@if($component->template == 1)
		<iframe src="https://www.youtube.com/embed/xh2eFeiEjCU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	@else
		<iframe src="{{str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/" , str_replace("https://youtu.be/","https://www.youtube.com/embed/",$component->content1))}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="width: 400px;height: 220px;"></iframe>
	@endif
</div>