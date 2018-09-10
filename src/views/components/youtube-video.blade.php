<div class="{{$component->columns}} columns youtube-video">
	@if(isset($component->content1))
		<iframe src="{{$component->content1}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	@else
		<iframe src="https://www.youtube.com/embed/12UMbVZ4t-M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	@endif
</div>