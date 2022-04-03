//Process User Posts
function facebook_insert_to_post(user_fb_id,facebookPosts,facebookStatus,long_token_data){
	console.log('Saving Post to DB');
	$.post( public_url+'save_post', {fbid:user_fb_id , fbposts:facebookPosts , fbstatus:facebookStatus} , function( save_post_result ) {
			console.log(save_post_result);
			facebook_update_likes(user_fb_id,long_token_data);
	}).fail(function() {
		console.log('*Failed Saving Post to DB Retry in 10 seconds');
		setTimeout(function() {facebook_insert_to_post(user_fb_id,facebookPosts,long_token_data);}, 10000);
	});
}