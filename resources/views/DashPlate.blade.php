<!DOCtype html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="{{url()}}/public/js/jquery.min.js"></script>
		<script src="{{url()}}/public/js/bootstrap.min.js"></script>
		<script src="{{url()}}/public/js/admin.js"></script>
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/Dashboard.css">
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/app.css">
		<!--Date Picker-->
		<script type="text/javascript" src="{{url()}}/resources/assets/datepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
		
		
	</head>
	<body>	
		<div id="Board">
			<div class="col-md-2 side_bar">
				<div class="col-md-12 side_menu">
					<div class="row">
						<img src="{{url()}}/public/IMG/logo_dash.png" width="140px" height="140px">
				 		<br>
				 	</div>
				 	<div class="clear"></div>
				 	<div class="col-md-12 menu_content">
						<div class="row">
							Dashboard<br><br>
				 		</div>
							<a href="{{url()}}/dashboard">
								<div class="col-md-12 menu_box ab "><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
									&nbsp;&nbsp;Manage Users
								</div></a>

							<a href="{{url()}}/branch">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span>
									&nbsp;&nbsp;Branch Offices
								</div></a>
					
							<a href="{{url()}}/editor">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									&nbsp;&nbsp;App Settings
								</div></a>
							<a href="{{url()}}/share">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>
									&nbsp;&nbsp;Post to Wall
								</div></a>
							
							<a href="{{url()}}/events">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								&nbsp;&nbsp;Events
								</div></a>
								
							<a href="{{url()}}/add-points">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
								&nbsp;&nbsp;Add Points
								</div></a>

							<a href="{{url()}}/suggestion">
								<div class="col-md-12 menu_box ab"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
								&nbsp;&nbsp;Feedback&nbsp;&nbsp;&nbsp;&nbsp; <span class="badge" style="color:rgb(38, 64, 77); background:#fff;">{{session('suggestion_count')}}</span>
								</div></a>

							

				 	</div>
				</div>

			</div>

			

			<div class="col-md-10 half_sideboard">
				<div class="col-md-12 header_board">

					<div class="col-md-3 search">
				        
				    </div>
				    <div class="clear"></div>
				</div>
				<div class="col-md-12 title_board">
				    <div class="col-md-5 title_content">@yield('page htag') </div>
				    <div class="clear"></div>
				    <div class="col-md-12 hr_div"><hr/>
				    <div class="clear"></div>
				    	@yield('submenu')
					</div>
				</div>
					<div class="col-md-12 D3">
						<div class="row col-md-12 shadow">
						
						@yield('content')
						<div class="clear"></div>
						<div class="row bottomspace_content" ></div>
					</div>
					<div class="clear"></div>
				</div>	
					
			</div>
		</div>
	</body>
</html>