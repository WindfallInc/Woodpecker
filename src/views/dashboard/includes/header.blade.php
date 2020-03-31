<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jaunt</title>
        <!-- FONTS -->
        <script src="https://use.fontawesome.com/72afff18ae.js"></script>
        <!-- CSS -->
        <link href="/css/woodpecker/admin.css" rel="stylesheet" type="text/css">
        <!-- SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="/js/fontawesome.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('header')

    </head>
    <body class="admin">

    @include('dashboard.partials.navigation')
