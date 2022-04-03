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

		$('.num_reward').text(userRewards);
		facebook_getLastScan(user_fb_id,long_token_data);


	}).fail(function() {
		console.log("*Can't Renew Token, retry in 10");
		setTimeout(function() {facebook_update_token(user_fb_id,long_token_data);}, 10000);
	});
}