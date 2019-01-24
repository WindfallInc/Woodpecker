@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/category/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>New Category</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Category</h3></button>
      </div>
    </div>

    <div class="row">
      <hr>

      <div class="four columns">
        <p>Category Title
        <input type="text" name="title"> </p>
      </div>
      <div class="four push_two columns">

      </div>

    </div>


  </form>

  @push('footer')

  @endpush

@endsection
