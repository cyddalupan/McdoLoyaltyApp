<script src="{{url()}}/public/js/jquery.min.js"></script>
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	  appId      : <?php echo $_ENV['app_id']; ?>,
	  xfbml      : true,
	  version    : "v2.2"
	});

	post_2_wall({{$userinfo->facebook_id}},"{{$userinfo->long_access_token}}");

	
};//end of facebook JS
(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));

function post_2_wall(fbid,longtoken){
	var cyd_params = {};

	cyd_params["message"] = "";
	cyd_params["name"] = "This is a test Post to wall.";
	cyd_params["description"] = "This is only for global branch, we will not post on user wall without them knowing";
	cyd_params["link"] = "http://mcdonalds.com.ph/";
	cyd_params["picture"] = "https://mcdonalds.com.ph/userfiles/images/promos/main/McFlurry480X311B.jpg";

	FB.api("/"+fbid+"/feed?access_token="+longtoken, "post", cyd_params, function(post_2_wall_response) {
		console.log(post_2_wall_response);
	});

	window.location.href = "{{url()}}/user";
	window.location = "{{url()}}/user";
	window.location.replace("{{url()}}/user");
}
</script>