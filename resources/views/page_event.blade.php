<!DOCtype html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta property="og:url" content="{{url()}}/public/page_event/{{$event->id}}"/>
      <meta property="og:title" content="{{$event->title}}"/>
      <meta property="og:description" content="{{strip_tags($event->description)}}"/>
      <meta property="og:site_name" content="{{$event->title}}"/>
      <meta property="og:image" content="{{url()}}/public/event_img/{{$event->img}}"/>
      <meta property="fb:app_id" content="{{$app_id}}"/>
      <meta property="og:type" content="article"/>

		<title>@yield('title')</title>		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		
		<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/eventspage.css">
		<!--Date Picker-->
		
		
	</head>
	<body>
     	  <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=314709202059299&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            
            <div class="row ">
              <div class="col-md-12 logo_event title_logo">
                  <img src="{{url()}}/public/IMG/Alpha_logo.png "width="95px" height="95px">          
                  &nbsp;&nbsp;Loyalty App
              </div>
              <div class="clear"></div>
              <div class="col-md-12 header_div">
                  <!--<div class="col-md-1" id="col-header"></div> 
                  <div class="col-md-11" id = "col-header "> -->
                          
              </div> 
                  <!--<div class="col-md-1" id="col-header"></div> -->
                
            </div>
            <div class="clear"></div>
        <div class="row">
        	<div class="col-md-1"></div>
            <div class="col-md-11" id="after-header">
                <!-- <h2>Events</h2><hr>
            </div>--> 
            <div class="col-md-1"></div>

        </div>
        <div class="row Eventhead">Events</div>
        <div class="clear"></div>

        <div class="row Event_content">
          <div class="clear"></div>
             
            <div class="col-md-1"></div>
            <div class="clear"></div>
            <div class="col-md-5" id = "content1">
              <div class="clear"></div>
                <h3>{{$event->title}}</h3>
                <P class = "date">Posted on {{date('F dS, Y',strtotime($event->event_date))}}</P>
                  <img src="{{url()}}/public/event_img/{{$event->img}}" width="472px"><br><br>
                <p class="text1">
                    {!! $event->description !!}
                </p>
                <div class="fb-share-button" data-href="{{url()}}/page_event/{{$event->id}}" data-layout="link" class="img-responsive share"></div>
                <hr/>
                <div class="events_comments">
                  <div class="fb-comments" data-href="{{url()}}/page_event/{{$event->id}}" data-numposts="5" data-colorscheme="light"></div>
                </div>
            </div> 
            <div class="col-md-5" id="content2">
                    <h3><ul><li><a href="{{url()}}/">Go to Profile</a></li></ul></h3><br><br>
                    <div class="fb-like-box" data-href="https://www.facebook.com/?q=#/McDo.ph?ref=br_tf" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
            </div> 
            <div class="col-md-1"></div>
        </div>   


        
        
        <br/><br/><br/><br/>
	</body>


	</html>