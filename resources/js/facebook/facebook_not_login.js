function facebook_not_login(response){
  	console.log("*User is not Log");
	//when join is clicked
	$('.join_me_in').click(function(){
  		console.log("Make User Log");
	    FB.login(function(response) {
			if (response.authResponse) {
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
					//user accept
	  				console.log("user accept fb-login");
					location.reload();
				});
			} else {
				console.log('User cancelled login or did not fully authorize.');
			}
	    }, {scope: global_scopes});
    });	
}