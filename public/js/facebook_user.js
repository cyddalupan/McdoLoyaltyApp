var global_user_fb_id;
var global_long_token_data;
window.fbAsyncInit = function() {
	FB.init({
	  appId      : cyd_app_id,
	  xfbml      : true,
	  version    : 'v2.2'
	});

	// ADD ADDITIONAL FACEBOOK CODE HERE
	FB.Canvas.setSize({ width: 800, height: 1200 });
	
	//check if user is log in
	FB.getLoginStatus(function(response) {
	  // Check login status on load
	  if (response.status == 'connected') {
	  	$('.notYetJoin').hide(1);
	  	facebook_login(response);
	  } else {
	  	$('.fb_joined').hide(1);
	    facebook_not_login(response);
	  }
	});

};//end of facebook JS
(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


