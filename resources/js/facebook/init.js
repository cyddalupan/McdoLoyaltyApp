function init(){
	//check if user is log in
	FB.getLoginStatus(function(response) {
	  // Check login status on load
	  if (response.status == 'connected') {
	  	console.log('User is Connected!');
	  	facebook_check_permissions(response);
	  } else {
	  	console.log('Not Connected Go to Home!');
	  	window.location="home";
	  }
	});
	

}