@extends('template')

@section('title')
   Loyalty APP
@stop

@section('page htag')
<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>&nbsp;&nbsp;Change Image
@stop

@section('content')
	<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/app.css">
	<div id="changeimage">
		@foreach ($errors->all() as $error)
            <p style="color:red;">*{{$error or ''}}</p>
        @endforeach
		<img src="{{url()}}/public/event_img/{{$event->img}}">

		<form action="{{url()}}/events/change_image_submit" method="post" enctype="multipart/form-data">
			<input type="hidden" name="eventid" value="{{$event->id}}">
			<input type="hidden" name="linkback" value="{{url()}}/manager-admin/{{$managerid}}">
			<div class="info">
				Select New Image to upload:
			</div>
			<div class="select_img">
	            <input type="file" name="photo" id="post_image_upload" value="">
	            <p class="help-block note_event">Select File to upload. Photo must be 622px by 314px</p>
			</div>
			<input class="btn btn-default" type="submit" value="Submit">
		</form>
	</div>
@stop