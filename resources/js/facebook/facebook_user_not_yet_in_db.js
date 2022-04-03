//if user is not yet on database. add it on DB
function facebook_user_not_yet_in_db(response,long_token_data){
	console.log('user not yet on user DB');
	$.post( public_url+'insert_user',{userinfo:response,newToken:long_token_data} , function( insert_user_result ) {
		console.log(insert_user_result);
		link_to_user(response.id);
	}).fail(function() {
		console.log("*Can't Insert User to DB, Retry in 10 seconds");
		setTimeout(function(){facebook_user_not_yet_in_db(response,long_token_data);}, 10000);
	});
}