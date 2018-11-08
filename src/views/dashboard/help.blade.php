@extends('layouts.dashboard')

@section('content')



  <form action="/dashboard/service/submit" method="POST">
    {{ csrf_field() }}
    <div class="row heading">
      <div class="four columns">
        <h3>Submit a Service Ticket</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="create">Send</h3></button>
      </div>
    </div>
    <div class="row">
      <div class="six columns">
        <input type="email" name="email" placeholder="Email Address" required>
      </div>
      <div class="six columns">
        <textarea name="problem" required>Describe what you need serviced</textarea>
      </div>
    </div>
    <div class="row">
      <div class="twelve columns">
        <textarea name="recreation">If you believe this to be a bug, please describe the steps to reproduce this error.</textarea>
      </div>
    </div>

    </form>


@endsection
