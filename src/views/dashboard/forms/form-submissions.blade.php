@extends('layouts.dashboard')

@section('content')

@push('header')

@endpush
  <form action="/dashboard/type/store" method="POST">
    {{ csrf_field() }}



    <div class="row heading">
      <div class="four columns">
        <h3>{{$form->title}}</h3>
      </div>
      <div class="four columns">
      </div>
      <div class="four columns">
        <a href="/dashboard/export/form/{{$form->id}}" target="_blank"><h3 class="store">Export Submissions</h3></a>
      </div>
    </div>
    <hr>
    @foreach($form->submissions as $submission)
    <div class="row submission">
        <div class="eight columns">
          {{$submission->created_at}}
          @foreach($submission->answers as $answer)
            <div class="row submission-details">
              <div class="four columns">
                {{$answer->question->title}}
              </div>
              <div class="eight columns">
                {{$answer->content}}
              </div>
            </div>
          @endforeach
        </div>
        <div class="four columns">
          <p class="edit">Details</p>
        </div>
    </div>
    @endforeach


  </form>

  @push('footer')
    <script>
    $('.submission .edit').click(function(){
      $(this).parents('.submission').find('.submission-details').toggleClass('active');
    })
    </script>
  @endpush

@endsection
