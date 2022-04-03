/*
 * javascript for lightbox on the upcoming carousel
 */
function slider_lightbox(){
	console.log('slider_lightbox activated!');

	//close the lightbox
	$('.sliderbox_close').click(function(){
		$('.black_divider').fadeOut('slow');
		$('.slider_lightbox').fadeOut('slow');
	});

	//click the upcoming events
	$('.uplight').click(function(){
		event_id = $(this).attr('event-id');

		$('.black_divider').fadeIn('slow');
		$('.slider_lightbox').fadeIn('slow');

		$.post( 'get_event',{event_id:event_id},function(jsonresult){
			console.log(jsonresult);
			//add value
			$('.lightbox_copytitle').html(jsonresult['title']);
			$('.lightboxtimedate_feed').html(jsonresult['nice_date']);
			$('.lightboximage_placement_img').attr("src",'public/event_img/'+jsonresult['img']);
			$('.lightboxcopy_ad').html(jsonresult['description']);
		},"json")
		.fail(function() {
		    alert( "Server Offline." );
		});
	});
}