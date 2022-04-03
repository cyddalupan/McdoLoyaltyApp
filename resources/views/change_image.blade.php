<html>
	<head>
		<title>
			Change Image
		</title>
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.css">
		<style type="text/css">
			body{
				background: #ecebeb;
			}
			
		</style>
		<script src="{{url()}}/public/js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#post_image_upload').click(function(){
					$( '.change_button' ).val('Upadate');
					$( '.change_button' ).removeClass( "btn-info" ).addClass( "btn-warning" );
				});
			});
		</script>
	</head>
	<body>
		<div id="changeimage">
		@foreach ($errors->all() as $error)
            <p style="color:red;">*{{$error or ''}}</p>
        @endforeach
		<img src="{{url()}}/public/event_img/{{$event->img}}">

		<form action="{{url()}}/events/change_image_submit" method="post" enctype="multipart/form-data">
			<input type="hidden" name="eventid" value="{{$event->id}}">
			<div class="info">
				Select New Image to upload:
			</div>
			<div class="select_img">
	            <input type="file" name="photo" id="post_image_upload" value="">
	            <p class="help-block note_event">Select File to upload. Photo must be 622px by 314px</p>
			</div>
			<input class="btn btn-info" type="submit" class="change_button" value="Change Image">
		</form>
	</div>
	</body>
</html>