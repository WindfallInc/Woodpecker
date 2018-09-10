<div class="{{$component->columns}} columns fancy-list">
			<h4>@if(isset($component->content1)){{$component->content1}}@else List Title @endif</h4>

				@if(isset($component->content2))
					{!!$component->content2!!}
				@else
					<ul>
						<li>Example item 1</li>
						<li>Example item 2</li>
						<li>Example item 3</li>
						<li>Example item 4</li>
						<li>Example item 5</li>
					</ul>
				@endif

</div>
