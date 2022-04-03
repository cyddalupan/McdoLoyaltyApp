//if user is alredy log in facebook
function facebook_login(response){
  	console.log("User is Log, Getting facebook Access Token");
	//get token
	cyd_token = '';
	FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
	    cyd_token = response.authResponse.accessToken;
	    facebook_token_generated(response,cyd_token);
	  }else{
	  	facebook_no_token(response);
	  }
	});
}