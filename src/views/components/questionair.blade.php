<div class="{{$component->columns}} columns form-items">

	@php $form = $component->form; $closed = true; $count = 0; @endphp
	@if(isset($form))

	<h3>{{$form->title}}</h3>
	<form action="/form/{{$form->id}}" method="post">
		{{ csrf_field() }}
		@foreach($form->questions->sortBy('order') as $q)
			@php $count = $count + $q->columnInt; @endphp
			@if($count > 12)
				</div>
				@php $count=$q->columnInt; $closed = true; @endphp
			@else
				@php $closed = false; @endphp
			@endif
			@if($closed == true || $loop->first)
			<div class="row">
				@php $closed=false; @endphp
			@endif

			<div class="{{$q->columns}} columns">
				<label for="{{$q->slug}}">{{$q->title}}</label>
				@if($q->type=='text-area')
					<br>
					<textarea name="{{$q->slug}}" id="" cols="30" rows="10"></textarea>
				@elseif($q->type=='section')

				@elseif($q->type=='radio')
					<div class="row">
						@foreach($q->children() as $child)
							<div class="{{$child->columns}} columns">
								<label for="{{$child->slug}}">{{$child->title}}</label>
								<input type="radio" name="{{$q->slug}}" value="{{$child->slug}}">
							</div>
						@endforeach
					</div>
				@else
					<input type="{{$q->type}}" placeholder="{{$q->placeholder}}" name="{{$q->slug}}" id="{{$q->slug}}">
				@endif
			</div>


			@if($loop->last)
				@if($closed == false)
					</div>
				@endif
				<div class="row">
					<div class="twelve columns">
						<input type="submit" value="{{$form->cta}}">
					</div>
				</div>
			@endif


		@endforeach
	</form>
	@else
		<p>Add Custom Form to Page</p>
	@endif

</div>
