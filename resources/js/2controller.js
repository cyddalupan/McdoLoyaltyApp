/*
 * this is the facebook controller
 */
function controller2(){
	var global_user_fb_id;
	var global_long_token_data;
	var allPostCountLoad2 = 0;

	//non facebook effects
	terms_and_condition_effects();

	window.fbAsyncInit = function() {
		FB.init({
		  appId      : cyd_app_id,
		  xfbml      : true,
		  version    : 'v2.2'
		});


		FB.Canvas.setSize({ width: 800, height: 1280 });

		if(page_title == 'index') init();

		if(page_title == 'LoyaltyAPPUser'){
			profile_join();
			suggestion_hide_suggestion_box();
			suggestions_show_suggestion_box();
			extendingsidebar();
		}

		if(page_title == 'Home') home_join();

		//check if facebook is online
		check_facebok = 1;


	};//end of facebook JS
	(function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
}