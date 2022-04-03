function extendingsidebar(){
	console.log('function extendingsidebar');

	/*
	$(document).scroll(function() {
		cydscrolltop = $(this).scrollTop();
		bitbit = cydscrolltop*0.7;
		$('.profile_title').css('margin-top',bitbit);
		$('.shadow_sidecol').css('height',cydscrolltop + 1200);
	});
*/
	setTimeout(function() {
		page_extender();
	}, 5000);

	$('.cyd_view_more').click(function(){
		$('.cyd_view_more').html('<img src="public/IMG/loading.gif"/>');

		setTimeout(function() {
			$('.per_event_hidden').fadeIn('4000');
			$('.cyd_view_more').css('display','none');
			setTimeout(function() {
				page_extender();
			}, 500);
		}, 5000);
	});



}

function page_extender(){
	//extend sidebar
	theheight_newsfeed = $('.newsfeed').height();
	theheight = theheight_newsfeed+327;
	$('.shadow_sidecol').css('height',theheight);

	//extend facebook
	theheight_newsfeed = $('.newsfeed').height();
	theheight = theheight_newsfeed+327;
	FB.Canvas.setSize({ width: 800, height: theheight });

}