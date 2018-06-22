<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <!-- Tell the browser to be responsive to screen width -->
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <!-- Favicon icon -->
	    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	    <title>Big Smile Admin - @yield('title')</title>

	    @include('partials.style')

	</head>

	<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
	    <div class="preloader">
	        <svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
			</svg>
	    </div>
	    <!-- Main wrapper  -->
	    <div id="main-wrapper">

	    @yield('navbar')
	    @yield('sidebar')
	    @yield('content')
	    @yield('footer')

	    </div>

	    @include('partials.script');
		
	</body>

</html>