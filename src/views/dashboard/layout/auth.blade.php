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

        @stack('header')
        <style>
        body {
            background-color: #fcfaf7;
            padding-top: 90px;
        }
        header {
          position: fixed;
          display: flex;
          justify-content: flex-start;
          align-items: center;
          top: 0;
          left: 0;
          right: 0;
          width: 100%;
          height: 90px;
        }
        header img {
          height:90px;
          border-right: solid 4px #333;
          margin-right:20px;
          padding-right:20px;
        }
        label {
            display: block;
            font-size: 12px !important;
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            margin-top: 20px;
            text-transform: uppercase;
            padding-left: 10px;
            line-height: 1.625em;
            cursor: pointer;
            margin-bottom: 9px;
        }
        .admin input {
          background-color:#fcfaf7;
        }
        .admin input[type="submit"] {
          background-color:#333;
        }
        </style>

    </head>

<body class="admin">

    <header>
      <img src="/css/woodpecker/woodpecker-logo.svg">
  		<h3 class="secondary-font">Login</h3>
  	</header>



    @yield('content')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
