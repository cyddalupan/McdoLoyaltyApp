@extends('DashPlate')

@section('title')
   Suggestions
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Feedback
@stop

@section('submenu')
	<ul class="nav nav-pills">
		<li role="presentation"><a href="{{url()}}/suggestion">Feeds</a></li>
		<li role="presentation" class="active"><a href="#">Trash</a></li>
	</ul>
@stop

@section('content')
	<style type="text/css">
		a{color:rgb(51, 122, 183);}
	</style>

	<div class="row" style="text-align:left; color:black; margin-left:30px;">
		@foreach($deleted_suggestions as $deleted_suggestion)
			
			<div class="col-md-5 suggestion_feed one-edge-shadow">	
			<div class="col-md-12 feedback_codename"><p>{{$deleted_suggestion->code_name}}</p><hr></div>
			
			
			<div class="col-md-12 feedback_comment"><p>{{$deleted_suggestion->description}}</p></div>		
			<br>
			<div class="col-md-12 feedback_date"><p>{{$deleted_suggestion->created_at}}</p></div>
			<br>
			
			
			</div>
		@endforeach

	</div>
@stop