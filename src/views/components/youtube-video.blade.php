<div class="{{$component->columns}} columns youtube-video" style="display: flex;justify-content: center;align-items: center;">
	@if(isset($component->content1))
		<iframe src="{{str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/" , str_replace("https://youtu.be/","https://www.youtube.com/embed/",$component->content1))}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="width: 400px;height: 220px;"></iframe>
	@else
		<iframe src="https://www.youtube.com/embed/12UMbVZ4t-M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	@endif
</div>