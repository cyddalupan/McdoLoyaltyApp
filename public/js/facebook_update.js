var allPostCountLoad2 = 0;

$(document).ready(function(){
	$('.cyd-update-points').click(function(){

		$('.num_point').html('<img src="'+public_url+'IMG/loading.gif" width="25px" height="25px" >');
		$('.num_post').html('<img src="'+public_url+'IMG/loading.gif" width="25px" height="25px" >');
		facebook_getLastScan();

		$(".cyd-update-points").hide(1);
	});
});
//get current users last scan date
function facebook_getLastScan(){
	user_fb_id = global_user_fb_id;
	long_token_data = global_long_token_data;
	console.log('Getting Last Scan Date');
	//call ajax
    var url=public_url+"last_scan/"+user_fb_id;
	var pmeters="";
	$.post(url,pmeters,function(lastScanUnixDate){
		console.log('The Last scan Date is '+ lastScanUnixDate);
		facebook_update_points(user_fb_id,long_token_data,lastScanUnixDate);
	});
}

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

//update likes of posts
function facebook_update_likes(user_fb_id,long_token_data){
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

//get the like count of post on facebook
function facebook_fetchNewLikeCount(user_fb_id,allPostID,long_token_data){
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


//Declare Object
ObjectLikeCount = {};
//update facebook like
function facebook_getEachPostLike(user_fb_id,allPostID,long_token_data,loopCount){
	console.log("Getting like Count for post "+allPostID[loopCount]);
	FB.api(
	    "/v2.2/"+allPostID[loopCount]+"/likes?summary=true&access_token="+long_token_data,
	    function (postLikeCount) {
	      	if (postLikeCount && !postLikeCount.error) {
	      		LikeCount = postLikeCount.summary.total_count;
      			facebook_pushToObject(allPostID,loopCount,LikeCount,user_fb_id,long_token_data);
	      	}else{
	      		console.log("*Cant Get Points Like Count.");
	      	}
	    }
	);
}

//insert value to a object
function facebook_pushToObject(allPostID,loopCount,LikeCount,user_fb_id,long_token_data){
    console.log("Successful ["+allPostID[loopCount]+"] likes = "+LikeCount+" loopCount = "+loopCount);
	//insert to an object
	pushObject = {
		postid : allPostID[loopCount],
		likeCount : LikeCount,
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

//sending javascript object to php to update like count
function facebook_update_postLike_DB(user_fb_id,long_token_data,ObjectLikeCount){
	console.log("Updating postLikeCount on DB...");
	$.post(public_url+'updateLikes', ObjectLikeCount, function( updateCountLikeResult ) {
		console.log(updateCountLikeResult);
		facebook_update_php_points(user_fb_id);
	}).fail(function() {
		console.log("*Can't Update LikesCount DB Retry In 10 seconds");
		setTimeout(function() {facebook_update_postLike_DB(user_fb_id,long_token_data,ObjectLikeCount);}, 10000);
	});
}

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

function facebook_change_points(totalpoints){
	//update points on frontend
	$('.num_point').text(totalpoints);
	$('.num_post').text(allPostCountLoad2);

	$('.onoff').fadeIn('slow');

	//$(".cyd-update-points").show('slow');
}