//update user points by adding all likes and points on the db
function facebook_update_php_points(user_fb_id){
	console.log("Updating Your Points");
	$.post( public_url+'update_points', {fbid:user_fb_id},function( TotalPoints ) {
		console.log(TotalPoints.Message);
		facebook_change_points(TotalPoints.totalpost);
	}, "json").fail(function() {
		console.log("*Can't Update Your Points");
		setTimeout(function() {facebook_update_php_points(user_fb_id);}, 10000);
	});
}