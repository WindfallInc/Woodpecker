<div class="{{$component->columns}} columns form-items">

	@php $form = $component->form; $closed = true; $count = 0; @endphp
	@if(isset($form))

	<h3>{{$form->title}}</h3>
	<form action="/form/{{$form->id}}" method="post" id="{{$form->id}}">
		@csrf
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
					<textarea name="{{$q->slug}}" id="" cols="30" rows="10" @if($q->required == 1) required @endif></textarea>
				@elseif($q->type=='section')

				@elseif($q->type=='radio')
					<div class="row">
						@foreach($q->children() as $child)
							<div class="{{$child->columns}} columns">
								<label for="{{$child->slug}}">{{$child->title}}</label>
								<input type="radio" name="{{$q->slug}}" value="{{$child->slug}}" @if($q->required == 1) required @endif>
							</div>
						@endforeach
					</div>
				@elseif($q->type=='select')
					<select name="{{$q->slug}}" id="{{$q->slug}}" @if($q->required == 1) required @endif>
						@foreach($q->children() as $child)
							<option value="{{$child->slug}}">
								{{$child->title}}
							</option>
						@endforeach
					</select>
				@else
					<input type="{{$q->type}}" placeholder="{{$q->placeholder}}" name="{{$q->slug}}" id="{{$q->slug}}" @if($q->required == 1) required @endif>
				@endif
			</div>


			@if($loop->last)
				@if($closed == false)
					</div>
				@endif
				<div class="row">
					<div class="twelve columns">
						{!! NoCaptcha::renderJs() !!}
						{!! NoCaptcha::displaySubmit($form->id, $form->cta) !!}
					</div>
				</div>
			@endif


		@endforeach
	</form>
	@else
		<p>Add Custom Form to Page</p>
	@endif

</div>
