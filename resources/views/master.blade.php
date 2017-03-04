<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.flatly.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
	@yield('head')

</head>
<body>

	<div class="navbar navbar-default">
		
		<div class="container">

			<div class="navbar-header">

				<div class="navbar-brand">

					<a href="{{ URL::to('/') }}">Pastebin</a>
				</div>
			</div>
			<div class="navbar-nav">
				
				<a href="{{ URL::to('/') }}" class="navbar-btn btn btn-success">New paste</a>
			</div>
			<ul class="nav navbar-nav">
				
				<li><a href="{{ URL::to('/popular') }}">Popular pastes</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>

					@if(Auth::check() == 1)
					
						<a href="{{ URL::to('/logout') }}">Logout</a>
					@else

						<a href="{{ URL::to('/register') }}">Register</a>
					@endif
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>

					@if(Auth::check() == 1)
					
						<a href="{{ URL::to('/dashboard') }}">Dashboard</a>
					@else

						<a href="{{ URL::to('/login') }}">Login</a>
					@endif
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		
		<div class="col-lg-10">
			
			@yield('content')
			<br><br><br>
		</div>
		<div class="col-lg-2">

			@include('lastPastes')
		</div>
	</div>
</body>
</html>