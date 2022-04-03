//if user info cant be retrieve because of api
function facebook_cant_get_api(response){
	console.log("*Can't get facebook data Retry In 10 seconds");
	setTimeout(function() {facebook_get_token(response);}, 10000);
}