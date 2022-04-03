//seek facebook post data of this user
function facebook_update_points(user_fb_id,long_token_data,lastScanUnixDate){
	console.log('Getting post from Facebook');
	if(lastScanUnixDate == 0)
		addscandate = '';
	else
		addscandate = ".since("+lastScanUnixDate+")";

	facebookPosts = '';
	facebookStatus = '';
	FB.api(
	    "/v2.2/me?fields=id,name,statuses"+addscandate+",posts"+addscandate+".limit(30){message,story,privacy,likes,updated_time}&access_token="+long_token_data,
	    function (feed_response) {
	      if (feed_response && !feed_response.error) {
	      	if ((typeof feed_response.posts != 'undefined') || (typeof feed_response.statuses != 'undefined')) {
		      	console.log("Get User Post Successful!");
		      	console.log(feed_response);

		      	if(typeof feed_response.posts != 'undefined')
		      		facebookPosts = feed_response.posts.data;

		      	if(typeof feed_response.statuses != 'undefined')
			      	facebookStatus = feed_response.statuses.data;

		      	facebook_insert_to_post(user_fb_id,facebookPosts,facebookStatus,long_token_data);
			}else{
				console.log("No New Facebook Post!");
				facebook_update_likes(user_fb_id,long_token_data);
			}
	      }else{
	      	console.log("*Cant Get User Points. Retry in 10 seconds");
			setTimeout(function() {facebook_update_points(user_fb_id,long_token_data,lastScanUnixDate);}, 10000);
	      }
	    }
	);
}