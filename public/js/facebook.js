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
					location.reload();
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
			link_to_user(response.id);
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

//if user is not yet on database. add it on DB
function facebook_user_not_yet_in_db(response,long_token_data){
	console.log('user not yet on user DB');
	$.post( public_url+'insert_user',{userinfo:response,newToken:long_token_data} , function( insert_user_result ) {
		console.log(insert_user_result);
		link_to_user(response.id);
	}).fail(function() {
		console.log("*Can't Insert User to DB, Retry in 10 seconds");
		setTimeout(function(){facebook_user_not_yet_in_db(response,long_token_data);}, 10000);
	  	facebook_login(response);
	});
}

function link_to_user(facebook_id){
	console.log('adding facebook_id to session')
	$.post( public_url+'loginsession',{facebook_id:facebook_id} , function( login_result ) {
		console.log(login_result);
		window.location="user";
	}).fail(function() {
		console.log("*Can't put id to session, Retry in 10 seconds");
		setTimeout(function(){link_to_user(facebook_id);}, 10000);
	});
}