@extends('dashboard.layout.dashboard')

@section('content')


<div class="dashboard-box row">
    <div class="row dark centering box-lrg">
      <p>Welcome to the Woodpecker Web Manager</p>
    </div>
    <div class="row">
      <div class="twelve columns centering">
        <a href="/dashboard/service/help"><p>Submit a Service Request ticket</p></a>
      </div>
    </div>
</div>
    @isset($tutorial)
      <img src="/css/woodpecker/tutorial-1.svg" alt="" class="tutorial">
    @endisset

@endsection
