@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/form/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>{{$form->title}}</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <button class="nope"><h3 class="store">Save Form</h3></button>
      </div>
    </div>

    <div class="row box">

      <div class="four columns">
        <p>Form Title
        <input type="text" name="title" value="{{$form->title}}"></p>
        <p>Form slug
        <input type="text" readonly name="slug" value="{{$form->slug}}"></p>
        <p class="mini">Note that all slugs update automatically with their corresponding titles</p>
        <p>Form CTA
        <input type="text" name="cta" placeholder="Submit, Send, Signup, Join, Etc..." value="{{$form->cta}}"></p>
        <p>Form Redirect
        <input type="text" name="redirect" placeholder="/thank-you,/home, Etc..." value="{{$form->redirect}}"></p>
      </div>
      <div class="four push_two columns">
        <a href="/dashboard/form/{{$form->slug}}/details"><h3 class="edit">Edit Items</h3></a>
        <ul class="box">
          @if(count($form->questions)>0)
          @foreach($form->questions as $q)
            <li>{{$q->title}}</li>
          @endforeach
          @else
            <li>You have no questions associated with this form, add some!</li>
          @endif
        </ul>
      </div>

    </div>


  </form>

  @push('footer')

  @endpush

@endsection
