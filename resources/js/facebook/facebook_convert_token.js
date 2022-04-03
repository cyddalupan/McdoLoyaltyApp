//convert token to long term
function facebook_convert_token(response,cyd_token,facebook_ids){
	console.log('function facebook_convert_token');
	console.log('Convert token to long term');
	//start ajax
    var url=public_url+"extend_token/"+cyd_token;
	var pmeters="";
	$.post(url,pmeters,function(long_token_data){
		console.log('New Token is '+long_token_data);
		//test id if already on DB
		//convert array to integer
		intfbid = [];
		$.each(facebook_ids, function( index, value ) {
			intfbid.push(parseInt(value));
		});
		
		//put facebook_id to variable
		user_fb_id = parseInt(response.id);
		//find the position on array if exist
		posInArray = $.inArray(user_fb_id, intfbid );
		//if greater than 0 = already exist
		if(posInArray >= 0){
			console.log("User Already On DB");
			if(page_title == 'LoyaltyAPPUser')
				facebook_update_token(response.id,long_token_data);
			else
				link_to_user(response.id);
		}
		//else add to database
		else{
			console.log('user not on db');
			facebook_user_not_yet_in_db(response,long_token_data);
		}

	}).fail(function() {
		console.log("*Can't Extend Token");
		setTimeout(function() {facebook_convert_token(response,cyd_token,facebook_ids);}, 10000);
	});
}