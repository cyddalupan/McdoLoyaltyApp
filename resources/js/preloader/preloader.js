var loading = 1;

$(document).ready(function(){
	console.log('PreLoader Loading Start!');

	//safary note
	note = 'Loading...';
	var ua = navigator.userAgent.toLowerCase(); 
	if (ua.indexOf('safari') != -1) { 
		if (ua.indexOf('chrome') > -1) {
		} else {
			console.log('preloader/preloader.js');
			note = "Safari Browser might Be Unable to load this app inside Facebook.";
		}
	}

	//loadmotion();
	$('.cyd_loading').html(note+'<br/><img src="public/IMG/loading.gif"/>');
});

$(window).bind("load", function() {
	//index keeps on loading
	if(page_title != 'index'){
		loading = 0;
		$('.cyd_loading').fadeOut(1);
	} 

   $('#home').css('height','1200px');
   $('#home').hide(1);
   $('#home').fadeIn('slow');
   
   $('#Profile').css('min-height','1200px');
   $('#Profile').css('height','auto');
   $('#Profile').hide(1);
   $('#Profile').fadeIn('slow');
   
	console.log('PreLoader Done Loading!');
});

function loadmotion(){
	setTimeout(function() {
		$('.cyd_loading').text('Loading.../');
	}, 100);
	setTimeout(function() {
		$('.cyd_loading').text('Loading...-');
	}, 200);
	setTimeout(function() {
		$('.cyd_loading').text('Loading...\\');
	}, 300);
	setTimeout(function() {
		$('.cyd_loading').text('Loading...|');
	}, 400);
	setTimeout(function() {
		if(loading == 1)
			loadmotion();
	}, 470);

}