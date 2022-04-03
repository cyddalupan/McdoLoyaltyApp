//update likes of posts
function facebook_update_likes(user_fb_id,long_token_data){
	console.log("function facebook update likes");
	console.log("Getting All Post Id using Facebook Id");
	$.post( public_url+'all_post_id', {fbid:user_fb_id},function( allPostID ) {
		console.log("All Post Id = "+allPostID);
		allPostCountLoad2 = allPostID.length;
		facebook_fetchNewLikeCount(user_fb_id,allPostID,long_token_data);
	}, "json").fail(function() {
		console.log("*Can't get all Post ID, Retry in 10 seconds");
		setTimeout(function() {facebook_update_likes(user_fb_id,long_token_data);}, 10000);
	});
}