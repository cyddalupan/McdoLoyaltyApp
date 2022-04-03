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
		
		<link rel="stylesheet" type="text/css" href="css/eventspage.css">
		<!--Date Picker-->
		
		
	</head>
	<body>
     	  
            <div class="row">
                <div class="col-md-1" id="col-header"></div> 
                <div class="col-md-11" id = "col-header"> 
                        <img src="{{url()}}/IMG/logo_events.png">
                        <p>LOYALTY APP</p>
                </div> 
                <!--<div class="col-md-1" id="col-header"></div> -->
      
            </div>
        <div class="row">
        	<div class="col-md-1"></div>
            <div class="col-md-11" id="after-header">
                 <h2>Events</h2><hr>
            </div> 
            <div class="col-md-1"></div>

        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5" id = "content1">
                <h3> Meals of Fortune</h3>
                <P class = "date">Posted on March 2nd, 2015 at 11:01pm</P>
                     <img src="{{url()}}/fortunemeal.jpg"><br><br>
                <p class="text1">
                Lorem ipsum dolor sit amet, consectetur adipiscing<br>
                elit. Nam suscipit venenatis condimentum. Fusce <br>
                sollicitudin dui iaculis turpis elementum, <br><br>
                
                vitae hendrerit enim pharetra. Vestibulum ante ipsum<br> 
                primis in faucibus orci luctus et ultrices posuere cubilia<br> 
                Curae; Proin massa urna, aliquam a pretium et, luctus <br>
                quis ante.<br>
                </p>
            </div> 
            <div class="col-md-5" id="content2">
                    <h3><ul><li>Go to Profile</li></ul></h3><br><br>
                    <img src="like_on_fb.jpg"><br>
            </div> 
            <div class="col-md-1"></div>
        </div>   


	</body>


	</html>