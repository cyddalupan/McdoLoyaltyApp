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
	//1036357483047530_1071799132836698?fields=shares,likes.summary(true),comments.summary(true)
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
var global_user_fb_id;
var global_long_token_data;
window.fbAsyncInit = function() {
	FB.init({
	  appId      : cyd_app_id,
	  xfbml      : true,
	  version    : 'v2.2'
	});

	// ADD ADDITIONAL FACEBOOK CODE HERE
	FB.Canvas.setSize({ width: 800, height: 1200 });
	
	//check if user is log in
	FB.getLoginStatus(function(response) {
	  // Check login status on load
	  if (response.status == 'connected') {
	  	$('.notYetJoin').hide(1);
	  	facebook_login(response);
	  } else {
	  	$('.fb_joined').hide(1);
	    facebook_not_login(response);
	  }
	});

};//end of facebook JS
(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//FUNCTIONS
//if user is not yet log on facebook
function facebook_not_login(response){
  	console.log("*User is not Log");
	//when join is clicked
	$('.join_me_in').click(function(){
  		console.log("Make User Log");
	    FB.login(function(response) {
			if (response.authResponse) {
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
					//user accept
	  				console.log("user accept fb-login");
					window.location="user/"+response.id;
				});
			} else {
				console.log('User cancelled login or did not fully authorize.');
			}
	    }, {scope: 'public_profile,user_birthday,read_stream,publish_actions'});
    });	
}

//if user is alredy log in facebook
function facebook_login(response){
  	console.log("User is Log, Getting facebook Access Token");
	//get token
	cyd_token = '';
	FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
	    cyd_token = response.authResponse.accessToken;
	    facebook_token_generated(response,cyd_token);
	  }else{
	  	facebook_no_token(response);
	  }
	});
}

//if facebook token cannot generate
function facebook_no_token(){
	console.log('*No Access Token Retry In 10 seconds');
	setTimeout(function(){location.reload();}, 10000);
}

//when generating facebook token is successful
function facebook_token_generated(response,cyd_token){
    console.log("Access Token Generated, Getting User Info");
	FB.api("/v2.2/me?fields=name,gender,birthday&access_token="+cyd_token,
	    function (response) {
	      if (response && !response.error) {
	      	facebook_user_retrieve_success(response,cyd_token);
	      }else{
	      	facebook_cant_get_api(response);
	      }
	    }
	);
}

//if user info cant be retrieve because of api
function facebook_cant_get_api(response){
	console.log("*Can't get facebook data Retry In 10 seconds");
	setTimeout(function() {facebook_get_token(response);}, 10000);
}

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

//convert token to long term
function facebook_convert_token(response,cyd_token,facebook_ids){
	console.log('Convert token to long term');
	//start ajax
    var url=public_url+"extend_token/"+cyd_token;
	var pmeters="";
	$.post(url,pmeters,function(long_token_data){
		console.log('New Token is '+long_token_data);
		//test id if already on DB
		//put facebook_id to variable
		user_fb_id = response.id;
		//find the position on array if exist
		posInArray = $.inArray(user_fb_id, facebook_ids );
		//if greater than 0 = already exist
		if(posInArray >= 0){
			console.log("User Already On DB");
			facebook_update_token(user_fb_id,long_token_data);
		}
		//else add to database
		else{
			facebook_user_not_yet_in_db(response,long_token_data);
		}
	}).fail(function() {
		console.log("*Can't Extend Token");
		setTimeout(function() {facebook_convert_token(response,cyd_token,facebook_ids);}, 10000);
	});
}

//update/renew user facebook token
function facebook_update_token(user_fb_id,long_token_data){
	console.log('Renew Facebook Token');
	//start ajax
    var url=public_url+"renew_token/"+user_fb_id+"/"+long_token_data;
	var pmeters="";
	$.post(url,pmeters,function(data){
		console.log(data);
		global_user_fb_id = user_fb_id;
		global_long_token_data = long_token_data;

/*
		$('.num_point').text(userPoints);
		$('.num_post').text(userTotalPost);

		$('.cyd-update-points').fadeIn('slow');
*/
		$('.num_reward').text(userRewards);
		facebook_getLastScan(user_fb_id,long_token_data);


	}).fail(function() {
		console.log("*Can't Renew Token, retry in 10");
		setTimeout(function() {facebook_update_token(user_fb_id,long_token_data);}, 10000);
	});
}

//if user is not yet on database. add it on DB
function facebook_user_not_yet_in_db(response,long_token_data){
	console.log('user not yet on user DB');
	$.post( public_url+'insert_user',{userinfo:response,newToken:long_token_data} , function( insert_user_result ) {
		console.log(insert_user_result);
		facebook_getLastScan(user_fb_id,long_token_data);
	}).fail(function() {
		console.log("*Can't Insert User to DB, Retry in 10 seconds");
		setTimeout(function(){facebook_user_not_yet_in_db(response,long_token_data);}, 10000);
	});
}

//# sourceMappingURL=all.js.map