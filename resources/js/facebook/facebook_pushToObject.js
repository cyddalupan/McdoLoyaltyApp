//Declare Object
ObjectLikeCount = {};
//insert value to a object
function facebook_pushToObject(allPostID,loopCount,LikeCount,commentCount,user_fb_id,long_token_data){
    console.log("Successful ["+allPostID[loopCount]+"] likes = "+LikeCount+"  Comment = "+commentCount+"  loopCount = "+loopCount);
	//insert to an object
	pushObject = {
		postid : allPostID[loopCount],
		likeCount : LikeCount,
    comcount : commentCount,
	};
	//push object to parent object
	ObjectLikeCount[loopCount] = pushObject;

  	//used for looping this same function. the count on the array
  	loopCount++;

  	//test if loopCount reach na maximum array length
  	if(loopCount < allPostID.length){
  		//add delay for safe scan
  		setTimeout(function() {
  			//call this same function but different loopCount.
			facebook_getEachPostLike(user_fb_id,allPostID,long_token_data,loopCount);
		}, 2000);
  	}else{
  		console.log("All Post(Likes(Count)) Has been Updated");
  		facebook_update_postLike_DB(user_fb_id,long_token_data,ObjectLikeCount);
  	}
}