function facebook_change_points(totalpoints){
	console.log('facebook_change_points');
	console.log('old point = '+totalpoints);
	newpoint = facebook_add_change_points(totalpoints);
	console.log('new point = '+newpoint);
	
	//update points on frontend
	$('.num_point').text(newpoint);
	$('.num_post').text(allPostCountLoad2);
	$('.onoff').fadeIn('slow');

	$('.onoff').fadeIn('slow');

}