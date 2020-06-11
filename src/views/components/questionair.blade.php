<div class="{{$component->columns}} columns form-items">

	@php $form = $component->form; $closed = true; $count = 0; @endphp
	@if(isset($form))

	<h3>{!!$form->title!!}</h3>
	<form action="/form/{{$form->id}}" method="post" id="woodpecker-form{{$form->id}}">
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
				<label for="{{$q->slug}}" class="{{$q->type}}-label">{!!$q->title!!}</label>
				@if($q->type=='text-area')
					<br>
					<textarea name="woodpecker{{$q->id}}" id="" cols="30" rows="10" @if($q->required == 1) required @endif class="woodpecker-textarea"></textarea>
				@elseif($q->type=='section')

				@elseif($q->type=='radio')
					<div class="row woodpecker-radio-section">
						@foreach($q->children() as $child)
							@if($child->columns == 'twelve')<span></span>@endif
							<div class="{{$child->columns}} columns">
								<input type="radio" name="woodpecker{{$q->id}}" value="{{$child->title}}" id="{{$child->slug}}" @if($q->required == 1) required @endif>
								<label for="{{$child->slug}}">{{$child->title}}</label>
							</div>
						@endforeach
					</div>
				@elseif($q->type=='checkbox-group')
					<div class="row woodpecker-checkbox-group" id="checkbox-group{{$q->id}}">
						<ul>
							@foreach($q->children() as $child)
								<li>
									<input type="checkbox" name="woodpecker{{$q->id}}[]" value="{{$child->title}}" id="{{$child->slug}}" @if($q->required == 1) required @endif>
									<label for="{{$child->slug}}">{{$child->title}}</label>
								</li>
							@endforeach
						</ul>
					</div>
				@elseif($q->type=='select')
					<select name="woodpecker{{$q->id}}" id="{{$q->slug}}" @if($q->required == 1) required @endif class="woodpecker-select">
						@foreach($q->children() as $child)
							<option value="{{$child->title}}">
								{{$child->title}}
							</option>
						@endforeach
					</select>
				@else
					<input type="{{$q->type}}" placeholder="{{$q->placeholder}}" name="woodpecker{{$q->id}}" id="{{$q->slug}}" @if($q->required == 1) required @endif class="woodpecker-input">
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
						<script>
						function onSubmit{{$form->id}}()
						{
							if($("#woodpecker-form{{$form->id}}")[0].checkValidity())
							{
								$("#woodpecker-form{{$form->id}}").submit();
							}
							else
							{
								alert('Please finish filling out the form before submitting.');
								$("<style type='text/css'> input:invalid {background-color: #CD5C5C;} </style>").appendTo("head");
							}
						}
						</script>

					</div>
				</div>
			@endif


		@endforeach
	</form>
	@else
		<p>Add Custom Form to Page</p>
	@endif

</div>


<script>
	$('.checkbox-group-label').on('click', function(){
		$(this).siblings('.woodpecker-checkbox-group').toggleClass('active');
		$(this).toggleClass('active');
	});
</script>