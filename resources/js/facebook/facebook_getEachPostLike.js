//update facebook like
function facebook_getEachPostLike(user_fb_id,allPostID,long_token_data,loopCount){
	console.log("function facebook get each post like");
	console.log("Getting like Count for post "+allPostID[loopCount]);
	FB.api("/","POST",{
		batch:[
			{"method":"GET", "relative_url":allPostID[loopCount]+"/likes?summary=true&access_token="+long_token_data},
			{"method":"GET", "relative_url":allPostID[loopCount]+"/comments?summary=true&access_token="+long_token_data},
			{"method":"GET", "relative_url":allPostID[loopCount]+"?access_token="+long_token_data}
		]
	},function (postLikeCount) {
      	if (postLikeCount && !postLikeCount.error) {
			//put privacy in a variable
			var privacy = $.parseJSON('[' + postLikeCount[2]['body'] + ']');
	    	privacyResult = 0;

	    	if(typeof(privacy[0]['error']) != "undefined" && privacy[0]['error'] !== null) {
	    		$.post( public_url+'delete_user_post',{user_post_post_id:allPostID[loopCount]});
	    		console.log(allPostID[loopCount]+" Deleted");
	    	}else if(typeof(privacy) != "undefined" && privacy !== null) {
	    		$.post( public_url+'user_post_change_privacy',{user_post_post_id:allPostID[loopCount],privacy:privacy[0]['privacy']['description']});
	    		console.log(allPostID[loopCount]+" Privacy Updated");
			}

	    	if (typeof privacy[0]['summary'] != 'undefined') {
	    		privacyResult = privacy[0]['summary']['total_count'];
			}

      		//put like in a variable
			var likeObj = $.parseJSON('[' + postLikeCount[0]['body'] + ']');
	    	likeCount = 0;
	    	if (typeof likeObj[0]['summary'] != 'undefined') {
	    		likeCount = likeObj[0]['summary']['total_count'];
			}
			//put comment on a variable
			var commentObj = $.parseJSON('[' + postLikeCount[1]['body'] + ']');
	    	commentCount = 0;
			if (typeof commentObj[0]['summary'] !== 'undefined') {
				commentCount = commentObj[0]['summary']['total_count'];
			}

			console.log(postLikeCount);
			
			//pust to db
  			facebook_pushToObject(allPostID,loopCount,likeCount,commentCount,user_fb_id,long_token_data);
      	}else{
      		console.log("*Cant Get Points Like Count.");
      	}
    });
}

/*
//update facebook like
function facebook_getEachPostLike(user_fb_id,allPostID,long_token_data,loopCount){
	console.log("Getting like Count for post "+allPostID[loopCount]);
	FB.api("/v2.2/"+allPostID[loopCount]+"/likes?summary=true&access_token="+long_token_data,
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
*/