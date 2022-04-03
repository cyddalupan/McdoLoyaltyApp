//get current users last scan date
function facebook_getLastScan(){
	user_fb_id = global_user_fb_id;
	long_token_data = global_long_token_data;
	console.log('Getting Last Scan Date');
	//call ajax
    var url=public_url+"last_scan/"+user_fb_id;
	var pmeters="";
	$.post(url,pmeters,function(lastScanUnixDate){
		console.log('The Last scan Date is '+ lastScanUnixDate);
		facebook_update_points(user_fb_id,long_token_data,lastScanUnixDate);
	});
}