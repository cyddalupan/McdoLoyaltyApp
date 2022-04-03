function suggestion_hide_suggestion_box(){
	$('.black_divider').click(function(){
		$('.black_divider').fadeOut('slow');
		$('.feedbox_shadow').fadeOut('slow');
		$('.slider_lightbox').fadeOut('slow');
	});
	
	$('.cyd_close').click(function(){
		$('.black_divider').fadeOut('slow');
		$('.feedbox_shadow').fadeOut('slow');
	});
}