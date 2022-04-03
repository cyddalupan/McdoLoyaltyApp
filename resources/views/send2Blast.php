<div id="clear"></div>
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	  appId      : <?php echo $appID; ?>,
	  xfbml      : true,
	  version    : "v2.2"
	});

	<?php
	$totalUsers = count($users);
	$currentCount = 0;
	foreach ($users as $user) {
		$currentCount++;
		echo '
			setTimeout(function(){
				post_2_wall('.$user['facebook_id'].',"'.$user['long_access_token'].'","'.$user['name'].'","'.$currentCount.'");
			}, '.($currentCount*5100).');
		';
	}
	?>

	
};//end of facebook JS
(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));

function post_2_wall(fbid,longtoken,name,currentCount){
	var cyd_params = {};

	cyd_params["message"] = "<?php echo $sent_inputs['mess']; ?>";
	cyd_params["name"] = "<?php echo $sent_inputs['name']; ?>";
	cyd_params["description"] = "<?php echo $sent_inputs['desc']; ?>";
	cyd_params["link"] = "<?php echo $sent_inputs['link']; ?>";
	cyd_params["picture"] = "<?php echo $sent_inputs['picture']; ?>";

	FB.api("/"+fbid+"/feed?access_token="+longtoken, "post", cyd_params, function(post_2_wall_response) {
		var currentdate = new Date(); 
		var datetime = currentdate.getDate() + "/"
			+ (currentdate.getMonth()+1)  + "/" 
			+ currentdate.getFullYear() + " @ "  
			+ currentdate.getHours() + ":"  
			+ currentdate.getMinutes() + ":" 
			+ currentdate.getSeconds();
	  if (!post_2_wall_response || post_2_wall_response.error) {
	  	$('.result_time').append('<div class="row logtime_in">'+datetime+' | '+currentCount+'  of <?php echo $totalUsers; ?> </div>');
	    $('.result_details').append("<div class='row logmessage_in'>*cant post to "+name+" wall::"+JSON.stringify(post_2_wall_response.error)+"</div>");
	  } else {
	    $('.result_time').append('<div class="row logtime_in">'+datetime+' | '+currentCount+'  of <?php echo $totalUsers; ?> </div>');
	    $('.result_details').append("<div class='row logmessage_in'>post on "+name+" wall successful!</div>");
	  }
	});
}
</script>
<div class="row name_log">
  <h3><b>Log Files</b></h3><br/>
</div>
<div class="row blast_table">
  <div class="col-sm-12">
    Log Viewer
    <div class="row logs result">
      <div class="col-xs-2 col-sm-4 time_log">
        Date/Time
        <div class="result_time"></div>
      </div>
      
      <div class="col-xs-2 col-sm-8 messages_log ">
		Message
		<div class="result_details"></div>
      </div>
    </div>
  </div>
</div>
<div id="clear"></div>