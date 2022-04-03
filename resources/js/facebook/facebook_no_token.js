//if facebook token cannot generate
function facebook_no_token(){
	console.log('*No Access Token Retry In 10 seconds');
	setTimeout(function(){location.reload();}, 10000);
}