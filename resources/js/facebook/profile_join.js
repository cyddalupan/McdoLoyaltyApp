function profile_join(){

	//check if user is log in
	FB.getLoginStatus(function(response) {
	  // Check login status on load
	  if (response.status == 'connected') {
	  	$('.notYetJoin').hide(1);
	  	facebook_check_permissions(response);
	  } else {
	  	$('.fb_joined').hide(1);
  		window.location="home";
	  }
	});
}