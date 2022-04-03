<html>
	<head>
		<title>
			Send Notification
		</title>
		<script src="{{url()}}/public/js/jquery.min.js"></script>
	</head>
	<body>
		<style type="text/css">
			.note{  
				text-align: center;
				position: absolute;
				font-family: monospace;
				top: 40px;
				left: 0;
				right: 0;
				margin: auto;
				font-size: 30px;
			}
			.notification_loading{
				border-radius: 10px;
				border: solid black 2px;
				height: 30px;
				width: 400px;
				position: absolute;
				top: 79px;
				left: 0;
				right: 0;
				margin: auto;
				overflow: hidden;
			}
			.notification_loading_bar{
				position: absolute;
				left: 0px;
				top: 0px;
				bottom: 0px;
				height: 100%;
				width: 0;
				background: orange;
			}
		</style>
		<div class="note">Informing Members</div>
		<div class="notification_loading">
			<div class="notification_loading_bar"></div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
				arraycount = {{count($approved_users)}};
				if(arraycount == 0){
					window.location.replace('{{url().'/manager-admin/'.$manager_id}}');
				}
				<?php $count = 0; ?>
				@foreach($approved_users as $approvedUser)
					<?php $count++; ?>
					setTimeout(function() {
						$.post('{{url()}}/send_notification_contact_fb',{facebook_id:'{{$approvedUser->facebook_id}}',access_token:'{{$approvedUser->long_access_token}}',message:'{{$event->title}}'},function(jsonresult){
							
						})
						.fail(function() {
						    console.log( "error" );
						})
						.done(function(result) {
						    console.log(result);
						})
						.always(function() {
						   if({{$count}} == arraycount){
						   		window.location.replace('{{url().'/manager-admin/'.$manager_id}}');
						   }
						});
						$('.notification_loading_bar').css('width',(({{$count}} / arraycount) * 100)+'%');
					}, (5000 * {{$count}}));
				@endforeach
			});
		</script>
	</body>
</html>