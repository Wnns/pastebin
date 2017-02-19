<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">

</head>
<body>

	<div class="navbar navbar-default">
		
		<div class="container">

			<div class="navbar-header">

				<div class="navbar-brand">

					<a href="/pastebin">Pastebin</a>
				</div>
			</div>
			<a href="/pastebin/addPaste" class="navbar-btn btn btn-success">New paste</a>
		</div>
	</div>
	<div class="container">
		
		<div class="col-lg-10">
			
			@yield('content')
		</div>
		<div class="col-lg-2">

			@yield('lastPastes')
		</div>
	</div>
</body>
</html>