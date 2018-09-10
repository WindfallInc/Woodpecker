@extends('layouts.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/form/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>New Form</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Form</h3></button>
      </div>
    </div>

    <div class="row">

      <div class="four columns">
        <p>Form Title
        <input type="text" name="title" placeholder="Leads, Contest Entries, Email signups, Etc..."></p>
        <p>&nbsp;</p>
        <p>Form CTA
        <input type="text" name="cta" placeholder="Submit, Send, Signup, Join, Etc..."></p>
        <p>Form Redirect
        <input type="text" name="redirect" placeholder="/thank-you,/home, Etc..."></p>
      </div>
      <div class="four push_two columns">


      </div>

    </div>


  </form>

  @push('footer')

  @endpush

@endsection
