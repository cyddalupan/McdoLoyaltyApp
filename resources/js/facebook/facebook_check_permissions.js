function facebook_check_permissions(response){
	//check permissions
	TotalCorrectPermissions = 0;
	AskAgainScope = '';
	console.log('Checking Facebook Permissions');
  	FB.api('/'+response.authResponse.userID+'/permissions', function(permissionResponse) {
		$.each( permissionResponse, function( globalKey, globalValue ) {
		 	$.each( globalValue, function( eachKey, eachValue) {
		 		$.each( global_scopes, function( scopeKey, scopeValue) {
		 			if(eachValue.permission == scopeValue){
		 				if(eachValue.status == 'granted'){
			 				TotalCorrectPermissions++;
			 			}else{
			 				AskAgainScope = AskAgainScope+scopeValue+',';
			 			}
		 			} 
				});
			});
		});
		if(TotalCorrectPermissions < 6){
			FB.api('/'+response.authResponse.userID+'/permissions','delete', function() {
				alert("Please Accept App Completely!");
				window.location="home";
			});
		}else{
			console.log('Facebook Permissions Complete');
  			facebook_login(response);
		}
	});
}
