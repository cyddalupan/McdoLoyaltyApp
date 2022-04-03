$(document).ready(function(){
	$('.toggle-off').click(function(){
		console.log("sending to user wall is on");
		change_point(switch_point);
		change_user_post_to_my_wall(me_fb_id,"yes");
	});
	$('.toggle-on').click(function(){
		console.log("sending to user wall is off");
		change_point(-switch_point);
		change_user_post_to_my_wall(me_fb_id,"no");
	});
});

function change_point(change){
	curpoint = parseInt($('.num_point').text());
	$('.num_point').text(curpoint+change);
}

function change_user_post_to_my_wall(me_fb_id,data){
	$.post( public_url+'update_user_post_to_my_wall',{me_fb_id:me_fb_id,data:data},function(switchresult){
		console.log(switchresult);
	})
	.fail(function() {
	    alert( "Access Failed, Please refresh and try again." );
	});
}