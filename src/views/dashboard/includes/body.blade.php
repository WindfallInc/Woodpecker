<!-- Begin body.php -->
{{--
* THIS FILE SHOULD NOT BE EDITED
* This file will be overwritten if the cms updates
* to make changes to this file, duplicate it
--}}
@if(isset($body))
  {!! $body->code !!}
@else
  @include('dashboard.includes.content-loop')
@endif
<!-- End body content -->
