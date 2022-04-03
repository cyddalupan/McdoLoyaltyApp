function home_join(){
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
}