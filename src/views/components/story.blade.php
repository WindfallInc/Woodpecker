<div class="{{$component->columns}} columns story">
	<h4>@if(isset($component->content1)){{$component->content1}} @else Example Story @endisset</h4>
	<img src="@if(isset($component->image)){{$component->image}}@else/component/placeholder.jpg @endif">
	@if(isset($component->content2)){!!$component->content2!!}@else Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, facere quia nobis deserunt mollit anim id est laborum. Impedit ad qui maiores minima laboriosam, asperiores, expedita cupiditate. @endif
</div>