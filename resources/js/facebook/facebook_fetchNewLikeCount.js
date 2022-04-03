//get the like count of post on facebook
function facebook_fetchNewLikeCount(user_fb_id,allPostID,long_token_data){
	console.log("function facebook fetch new like Count");
	console.log("Getting Count Of Likes On facebook");
	//put loop count to zero. this function will loop to all post needs to start with zero
	loopCount = 0;

	if(allPostID.length > 0){
		facebook_getEachPostLike(user_fb_id,allPostID,long_token_data,loopCount);
	}else{
		console.log("*User has No Post Yet");
		facebook_change_points(0);
	}
}