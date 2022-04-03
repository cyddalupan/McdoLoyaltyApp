//if Getting user info was a success
function facebook_user_retrieve_success(response,cyd_token){
	console.log("Getting user info Success!");
	//start ajax
	$.post( public_url+'all_fb_id', function( facebook_ids ) {
		console.log("Getting All User ID Success!");
		facebook_convert_token(response,cyd_token,facebook_ids);
	}, "json").fail(function() {
		console.log("*Can't get all Post ID, Retry in 10 seconds");
		setTimeout(function() {facebook_user_retrieve_success(response,cyd_token);}, 10000);
	});
}