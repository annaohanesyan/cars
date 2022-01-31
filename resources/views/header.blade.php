<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Scarica gratis GARAGE Template html/css - Web Domus Italia - Web Agency </title>
	<meta name="description" content="Scarica gratis il nostro Template HTML/CSS GARAGE. Se avete bisogno di un design per il vostro sito web GARAGE può fare per voi. Web Domus Italia">
	<meta name="author" content="Web Domus Italia">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="template/source/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="template/source/font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="template/style/slider.css">
	<link rel="stylesheet" type="text/css" href="template/style/mystyle.css">
</head>
<body>
<!-- Header -->
<div class="allcontain">
	<div class="header">
			<ul class="socialicon">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
			</ul>
			<ul class="givusacall">
				<li style="font-size:14px">Give us a call : +66666666 </li>
			</ul>
			<ul class="logreg">
				@if (Route::has('login'))
					
                    @auth
                        <li><a href="{{ url('/user') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ trans('messages.Home') }}</a></li>
                    @else
                        <li><a href="{{ route('login') }}" style="color:white; font-size:18px">{{ trans('messages.Log in') }}</a></li>

                        @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="ml-4" style="color:white; font-size:18px; margin-left:50px">{{ trans('messages.Register') }}</a></li>
                        @endif
                    @endauth
					
				@endif

                   
				<li style="font-size:18px; margin-left:40px"><a class="ml-1 underline ml-2 mr-2" href="{{asset('locale/am')}}">am</a> </li>
				<li style="font-size:18px"><a class="ml-1 underline ml-2 mr-2" href="{{asset('locale/en')}}"> en</a> </li>
			</ul>
	</div>
	<!-- Navbar Up -->
	<nav class="topnavbar navbar-default topnav">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed toggle-costume" data-toggle="collapse" data-target="#upmenu" aria-expanded="false">
					<span class="sr-only"> Toggle navigaion</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand logo" href="/"><img src="template/image/logo1.png" alt="logo"></a>
			</div>	 
		</div>
		<div class="collapse navbar-collapse" id="upmenu">
			<ul class="nav navbar-nav" id="navbarontop">
				<li class="active"><a href="/">{{ trans('messages.Home') }}</a> </li>
				<li class="dropdown">
					<a href="{{ route('collection') }}" class="dropdown-toggle"	data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('messages.Cars') }}</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('messages.Services') }}</a>
				</li>
				<li>
					<a href="#">{{ trans('messages.Contacts') }}</a>
 
				</li>
				<button><span class="postnewcar">POST NEW CAR</span></button>
			</ul>
		</div>
	</nav>
</div>
<!--_______________________________________ Carousel__________________________________ -->
