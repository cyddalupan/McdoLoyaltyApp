<!DOCtype html>
<html>
	<head>
   		<meta name="viewport" content="width=device-width, initial-scale=1">
   		<style type="text/css">
			#home{height:0;}
			#Profile{min-height: 0; height: 0; overflow: hidden;}
		</style>
		<title>@yield('page_title')</title>
		<script src="{{url()}}/public/js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/preloader.css">
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/styleloyalty.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap-theme.min.css">
		<link href="{{url()}}/public/css/bootstrap-toggle.min.css" rel="stylesheet">
		<!-- bxSlider CSS file -->
		<link href="{{url()}}/resources/assets/mcslider/jquery.bxslider.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/profile.css">
		<style type="text/css">.cyd-update-points{display: none;}</style>
	</head>
	<body>
		<!--preloader-->
		<div class="cyd_loading">Loading...</div>
		@yield('content')
		<div class="row black_divider"></div>
		<h1 id="fb-welcome"></h1>
		<div id="fb-root"></div>
		<script src="{{url()}}/public/js/all.js"></script>
	</body>
</html>