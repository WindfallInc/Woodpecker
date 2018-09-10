@extends('layouts.app')

@section('content')



    <div class="hero"
      style="
      background-image: url('{{$page->featimg()}}');
      ">

        <h1>{!! $page->title !!}</h1>

    </div>

    <div class="intro topo">
        <div class="row">
            <div class="eight columns push_two">
                {!! $page->get_the('Introduction Text') !!}
            </div>
        </div>
    </div>

<div class="row post-content">

  @include('includes.content-loop')


</div>



@endsection
