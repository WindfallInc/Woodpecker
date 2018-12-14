<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>@if(isset($title)) {{$title}}@elseif (isset($page->title)){{$page->title}} @endif | Website Title</title>
        <!-- FONTS -->

        <!-- CSS -->
        <link href="/css/quickstart/app.css" rel="stylesheet" type="text/css">
        <!-- SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        @stack('header')

    </head>
    <body @if(isset($page->catagories)) class="@foreach($page->catagories as $cat){{ $cat->slug }}"@endforeach @endif>

    @include('partials.navigation')
