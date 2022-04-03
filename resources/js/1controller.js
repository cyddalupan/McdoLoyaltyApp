/*
 * Main JavaScript File
 * Author: Cyd Dalupan (cyddalupan@icloud.com)
 */
page_untrim_title = $(document).find("title").text();
page_title = page_untrim_title.trim();
page_title = page_title.replace(/\s/g, '');
console.log('page title = ',page_title);

check_facebok = 0;

$(document).ready(function(){

	if(
		(page_title == 'index') ||
		(page_title == 'LoyaltyAPPUser') ||
		(page_title == 'Home')
	){
		controller2();

		//check if connected to facebook
		setTimeout(function() {
			if(check_facebok == 0){
				alert('facebook is offline. Please Refresh. If You Think This is an Error. Please Contact The Developer. cyddalupan@icloud.com');
			}
		}, 10000);
	}

	if(page_title == 'LoyaltyAPPUser'){
		suggestion_send();
		slider_lightbox();
	}

});