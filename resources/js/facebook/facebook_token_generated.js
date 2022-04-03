//when generating facebook token is successful
function facebook_token_generated(response,cyd_token){
	console.log("function facebook_token_generated");
    console.log("Access Token Generated, Getting User Info");
	FB.api("/v2.2/me?fields=name,gender,birthday&access_token="+cyd_token,
	    function (response) {
	      if (response && !response.error) {
	      	facebook_user_retrieve_success(response,cyd_token);
	      }else{
	      	facebook_cant_get_api(response);
	      }
	    }
	);
}