@extends('dashboard.layout.dashboard')

@section('content')

  @push('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endpush


    <div class="row">
      <div class="ten push_one columns strip">
        <h1 class="-brown">{{$form->title}} Submissions</h1>
      </div>
    </div>
    <div class="dashboard-box row">

      <div class="box-header row">
        <a id="massdelete" class="one column push_nine preview-submit"><i class="far fa-trash-alt"></i></a>
        <a href="/dashboard/export/form/{{$form->id}}" target="_blank" class="two columns store"><i class="fas fa-download"></i></a>
      </div>
      <div class="dashboard-list">
        <div class="editor_zone" id="editor_zone">
          @foreach($form->submissions as $submission)
          <div class="row submission">
              <div class="seven push_one columns">
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
                <p class="edit"><i class="fas fa-eye"></i></p>
              </div>
              <div class="two columns">
                <p class="delete" data-id="{{$submission->id}}"><i class="far fa-trash-alt"></i></p>
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>






  @push('footer')
    <script>
    $('.submission .edit').click(function(){
      $(this).parents('.submission').find('.submission-details').toggleClass('active');
    })

    $('#massdelete').on('click',function(e){
      e.preventDefault();
      var answer=confirm('Do you want to delete every submission for this form?');
      if(answer){
          window.location.href = '/dashboard/form/{{$form->id}}/massdelete';
      }
      else{
          alert('Not Deleted');
      }
    });
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
