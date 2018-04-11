<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name', 'theSchool')}}</title>
    {{--  <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->  --}}
	{{--  <!-- <link href="font/Courgette-Regular.ttf" rel="stylesheet"> -->  --}}
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
    {{--  <link href="{{asset('css/style.css')}}" rel="stylesheet">  --}}
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>
<body >
	@include('inc.navbar')
    <section id="content">
        @include('inc.messages')
        @yield('content')
    </section>
</body>
</html>