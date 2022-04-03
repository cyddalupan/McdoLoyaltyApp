function link_to_user(facebook_id){
	console.log('function link_to_user');
	console.log('adding facebook_id to session');
	$.post( public_url+'loginsession',{facebook_id:facebook_id} , function( login_result ) {
		console.log(login_result);
		console.log('redirect url = '+public_url+"user");
		window.location.href = public_url+"user";
		window.location = public_url+"user";
		window.location.replace(public_url+"user");
	}).fail(function() {
		console.log("*Can't put id to session, Retry in 10 seconds");
		setTimeout(function(){link_to_user(facebook_id);}, 10000);
	});
}