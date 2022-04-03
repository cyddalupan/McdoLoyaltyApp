<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{url()}}/css/bootstrap.css">
<!-- Optional theme -->
<link rel="stylesheet" href="{{url()}}/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="{{url()}}/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url()}}/css/styleloyalty.css">
<!--Switches-->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>	

<!--facebook JS-->
<script type="text/javascript">
	//declare app_id
	var cyd_app_id = {{$app_id}};
	var public_url = "{{url()}}/";
	var me_fb_id = {{$userInfo->facebook_id}};
	var userPoints = {{$userInfo->points}};
	var userRewards = {{$userInfo->rewards}};
	var userTotalPost = {{$post_count}};
	var switch_point = {{$switch_point}};
</script>
<style type="text/css">.cyd-update-points{display: none;}</style>
<script src="{{url()}}/js/facebook_user.js"></script>
<script src="{{url()}}/js/facebook_update.js"></script>

<!--post to wall slider data sender-->
<script src="{{url()}}/js/slider_data_sender.js"></script>

<!--page css-->
<link rel="stylesheet" type="text/css" href="{{url()}}/css/profile.css">