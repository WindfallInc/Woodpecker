@extends('dashboard.layout.dashboard')

@section('content')

  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
              <div class="twelve columns">
                <p style="background-color:#eee;">{{$answer->question->title}}</p>
                <p>{{$answer->content}}</p>
              </div>
            </div>
          @endforeach
        </div>
        <div class="two columns">
          <p class="edit">Details</p>
        </div>
        <div class="two columns">
          <p class="delete" data-id="{{$submission->id}}">Delete</p>
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
    <script>
    $(document).on('click', '.delete', function(e){
      var postId = $(this).data("id");
      console.log($(this).data("id"));
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/dashboard/submission/delete',
        data: {postId: postId},
      })

      $(this).parents('.submission').remove();
    });
    </script>
  @endpush

@endsection
