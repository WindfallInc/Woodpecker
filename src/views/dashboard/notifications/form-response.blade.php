@extends('email.base')

@section('content')

	<h1>New Submission to {{$submission->form->title}} Form</h1>
  <p>&nbsp;</p>
  @foreach($submission->answers as $answer)
    <p>{{$answer->question->title}}: {{$answer->content}}</p>
  @endforeach
  <p>&nbsp;</p>
	<p class="centered" style="text-align:center;"><a href="{{get_the_setting('Site Url')}}/dashboard/form/{{$submission->form->id}}/submissions">View all submissions</a></p>

@endsection