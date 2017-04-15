<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<title>Kardex</title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendor.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/flat-admin.css') }}">

	<!-- Theme -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue-sky.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/blue.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/red.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/theme/yellow.css') }}">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
    <div class="app app-default">
		<div class="app-container app-login">
			<div class="flex-center">
				<div class="app-body">
					<div class="loader-container text-center">
						<div class="icon">
							<div class="sk-folding-cube">
								<div class="sk-cube1 sk-cube"></div>
								<div class="sk-cube2 sk-cube"></div>
								<div class="sk-cube4 sk-cube"></div>
								<div class="sk-cube3 sk-cube"></div>
							</div>
						</div>
						<div class="title">@yield('title')</div>
					</div>
					<div class="app-block">
						<div class="app-form">
                            @yield('content')
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
