<html>
	<head>
		<title>
			Quick Settigns
		</title>
		<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.css">
		<style type="text/css">
			body{
				background: #ecebeb;
			}
			h1 {
				margin: 10px 0 11px 1px;
    			font-family: sans-serif;
			}
			p {
				float: left;
				margin-right: 1px;
				margin-left: 3px;
			}
			p input{
				 width: 110px;
			}
			.quick_button{
				  margin-top: -2px;
				  margin-left: 3px;
			}
		</style>
		<script src="{{url()}}/public/js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('input').click(function(){
					$( '.quick_button' ).val('Upadate');
					$( '.quick_button' ).removeClass( "btn-info" ).addClass( "btn-warning" );
				});
			});
		</script>
	</head>
	<body>
		<h1>
			KeyWords
		</h1>
		<form action="{{url()}}/editor/quick_submit" method="post" class="quick_form">
			<p>
				<input type="text" name="find_word" value="{{$settingArr['find_word']}}" />
			</p>
			<p>
				<input type="text" name="find_word_2" value="{{$settingArr['find_word_2']}}" />
			</p>
			<p>
				<input type="text" name="find_word_3" value="{{$settingArr['find_word_3']}}" />
			</p>
			<p>
				<input type="text" name="find_word_4" value="{{$settingArr['find_word_4']}}" />
			</p>
			<p>
				<input type="text" name="find_word_5" value="{{$settingArr['find_word_5']}}" />
			</p>
			<input type="submit" class="btn btn-info btn-sm quick_button" value="Save">
		</form>
	</body>
</html>