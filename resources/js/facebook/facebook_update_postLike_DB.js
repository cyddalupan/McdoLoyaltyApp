//sending javascript object to php to update like count
function facebook_update_postLike_DB(user_fb_id,long_token_data,ObjectLikeCount){
	console.log("function facebook update postLike DB");
	console.log("Updating postLikeCount on DB...");
	$.post(public_url+'updateLikes', ObjectLikeCount, function( updateCountLikeResult ) {
		console.log(updateCountLikeResult);
		facebook_update_php_points(user_fb_id);
	}).fail(function() {
		console.log("*Can't Update LikesCount DB Retry In 10 seconds");
		setTimeout(function() {facebook_update_postLike_DB(user_fb_id,long_token_data,ObjectLikeCount);}, 10000);
	});
}