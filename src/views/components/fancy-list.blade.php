<!-- fancy-list component -->
<div class="{{$component->columns}} columns fancy-list">
			<h4>@if($component->template == 1) List Title @else {!!$component->content1!!} @endif</h4>

				@if($component->template == 1)
					<ul>
						<li>Example item 1</li>
						<li>Example item 2</li>
						<li>Example item 3</li>
						<li>Example item 4</li>
						<li>Example item 5</li>
					</ul>
				@else
					{!!$component->content2!!}
				@endif

</div>
