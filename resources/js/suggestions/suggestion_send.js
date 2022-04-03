/*
 * Sending Suggestions to php
 * to be saved on DB
 */
function suggestion_send(){
	$('.submit_suggestion').click(function(){
		optinal_namebox = $('.optinal_namebox').val();
		comment_box = $('.comment_box').val();
		
		$('.submit_suggestion').hide(1);

		$.post( 'insert_suggestion',{suggestion_title:optinal_namebox,suggestion_content:comment_box,fb_id:me_fb_id},function(suggestion_callback){
			$('.feedbox_shadow').fadeOut('slow');
			console.log(suggestion_callback);
		})
		.fail(function() {
		    alert( "Connection Error: Please Refresh this Page." );
		})
		.done(function(suggestion_callback) {
		    $('.black_divider').fadeOut('slow');
		})
		.always(function() {
		    $('.title_feedback').text('Thanks for Sending Feedback.');
		    $('.copy_feedback').fadeOut('slow');
		    $('.message_us').fadeOut('slow');
		});
	});
}