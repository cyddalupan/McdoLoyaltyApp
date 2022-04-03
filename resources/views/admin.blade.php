<!DOCtype html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/admin.js"></script>
		<link rel="stylesheet" type="text/css" href="css/styleloyalty.css">
	</head>
	<body>
	<style type="text/css">
	html, body{
		background-color: #ebebeb;
		height: 500px;
			width:100%;
		}
		.admin_size{
			max-width: 1080px;
		}
		.id_place{
			margin-left: 50px;
		}
		.form{
			margin-left: 389px;
			float: left;
			margin-top: -178px;
		}
		@media (max-width: 720px){

		   div {
		         width: 100% !important;
		         padding: 0 !important;
		         margin: auto !important;
		         clear: both !important;
		         margin: 0 !important;
	         
	    		}
			    .admin_size{
			    	text-align: center;
				}
				.id_place{
					text-align: center;
				}
				.form_media{
					text-align: left;
					float: left;
					margin-top: -270px;
					padding: 73px;
					font-size: 10px;
					margin-left: 45px;
				

				}
			}
	</style>	
		<div id="Admin">
			<div class="col-md-2"></div>
		  	<div class="col-md-8 id_place"><img src="../public/IMG/LOGIN.jpg"></div>
			<div class="col-md-2"></div>
		</div>
		<div class="row admin_size">
			<div class="col-md-2 "></div>
			<div class="col-md-8 form">

				<form class="form-inline form_media">
					  <div class="form-group">
					    <label for="exampleInputName2">USERNAME&nbsp;&nbsp;</label>
					    <input type="text" class="form-control" id="exampleInputName2" placeholder="Admin">
					  </div>
					  <br>
					  <br>
					  <div class="form-group">
					    <label for="exampleInputEmail2">PASSWORD&nbsp;&nbsp;</label>
					    <input type="password" class="form-control" id="exampleInputEmail2" placeholder="Password">
					  </div>
					  <br>
						<button class="btn btn-default login_btn" type="submit">LOGIN</button>
					  
				</form>
			</div>
			<div class="col-md-2"></div>

		</div>	
	</body>
</html>