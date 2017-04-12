<!DOCTYPE html>
<html>
<head>
	<title>Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/flat-admin.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

	<!-- Theme -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue-sky.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/red.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/yellow.css') }}">

</head>
<body>
	<div class="app app-default">

		<aside class="app-sidebar" id="sidebar">
			<div class="sidebar-menu">
				<ul class="sidebar-nav">
					<li class="">
						<a href"{{ route('home') }}">
							<div class="icon">
								<i class="fa fa-tasks" aria-hidden="true"></i>
							</div>
							<div class="title">Estudiantes</div>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<div class="icon">
								<i class="fa fa-file-o" aria-hidden="true"></i>
							</div>
							<div class="title">Pages</div>
						</a>
						<div class="dropdown-menu">
							<ul>
								<li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Admin</li>
								<li><a href="../pages/form.html">Form</a></li>
								<li><a href="../pages/profile.html">Profile</a></li>
								<li><a href="../pages/search.html">Search</a></li>
								<li class="line"></li>
								<li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Landing</li>
								<!-- <li><a href="../pages/landing.html">Landing</a></li> -->
								<li><a href="../pages/login.html">Login</a></li>
								<li><a href="../pages/register.html">Register</a></li>
								<!-- <li><a href="../pages/404.html">404</a></li> -->
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<div class="app-container">
			<div class="col-xs-12">
				@yield('content')
			</div>
		</div>
	</div>
  
	<script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/app-sidebar.js') }}"></script>

</body>
</html>