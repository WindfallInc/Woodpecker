@extends('dashboard.layout.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/form/store" method="POST">
    {{ csrf_field() }}


    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">{{$form->title}}</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <div class="ten columns">

        </div>
        <div class="two columns store">
          <i class="fa fa-sign-in"></i>
        </div>
      </div>
      <div class="dashboard-list">
        <div class="editor_zone" id="editor_zone">
          <div class="row box">

            <div class="four push_one columns">
              <p>Form Title
              <input type="text" name="title" value="{{$form->title}}"></p>
              <p>Form slug
              <input type="text" readonly name="slug" value="{{$form->id}}"></p>
              <p class="mini">Note that all slugs update automatically with their corresponding titles</p>
              <p>Form CTA
              <input type="text" name="cta" placeholder="Submit, Send, Signup, Join, Etc..." value="{{$form->cta}}"></p>
              <p>Form Redirect
              <input type="text" name="redirect" placeholder="/thank-you,/home, Etc..." value="{{$form->redirect}}"></p>
            </div>
            <div class="four push_two columns">
              <a href="/dashboard/form/{{$form->id}}/details"><h3 class="edit">Edit Items</h3></a>
              <ul class="box">
                @if(count($form->questions)>0)
                @foreach($form->questions->sortBy('order') as $q)
                  <li>{{$q->title}}</li>
                @endforeach
                @else
                  <li>You have no questions associated with this form, add some!</li>
                @endif
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>




  </form>

  @push('footer')

  @endpush

@endsection
