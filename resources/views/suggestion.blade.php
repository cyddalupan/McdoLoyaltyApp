@extends('DashPlate')

@section('title')
   Suggestions
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Feedback
@stop

@section('submenu')
	<ul class="nav nav-pills">
		<li role="presentation" class="active"><a href="#">Feeds</a></li>
		<li role="presentation"><a href="{{url()}}/suggestion/trash">Trash</a></li>
	</ul>
@stop

@section('content')
	<style type="text/css">
		a{color:rgb(51, 122, 183);}
		.suggestion_day{ cursor: pointer;}
		.suggestion_list{ width: 100% !important; display: none;}
	</style>
	
	<div class="col-xs-9 feedbacktab_desc">View feedback from registered employees.</div>
	<div class="clear"></div>
	<div class="col-md-10"><hr/></div>
	<div class="clear"></div>
	<div id="Feedback_Table">
		
		<div class="col-md-8 feedback_collection"><b>FEEDS PER DAY</b> </div>
	  	<div class="clear"></div>
	  	<?php $suggestion_day = 0; ?>
		@foreach($suggestions as $suggestion)
		<?php $suggestion_day++; ?>
		<div class="col-md-8 date_feedback">
			
			<div class="col-md-10 date_feedback suggestion_day suggestion_day{{$suggestion_day}}"><p>
				
				<span class="glyphicon glyphicon-chevron-down feedback_dwnbt " aria-hidden="true"></span>{{$suggestion['day']}}</p></div>
			<div class="col-md-2 date_feedback_remove">
				<a href="{{$suggestion['delete_whole_day_link']}}">&nbsp;&nbsp;&nbsp;Delete
					<span class="glyphicon glyphicon-minus-sign remove" aria-hidden="true"></span>
                </a>
            </div>
            <div class="col-md-12 backgroundfeed_percollection suggestion_list suggestion_list{{$suggestion_day}}">
				@foreach($suggestion['values'] as $value)	
				<div class="col-md-6 backgroundfeed_percollection">
					<div class="col-md-11 suggestion_feed one-edge-shadow">	
						<div class="col-md-12 feedback_codename"><p>{{$value['code_name']}}</p><hr></div>
						<div class="col-md-12 feedback_comment"><p>{{$value['description']}}</p></div>		
						<br>
						<div class="col-md-12 feedback_delete">
							<a href="{{$value['delete_link']}}"> 
							<span class="glyphicon glyphicon-minus-sign remove" aria-hidden="true"></span></a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<hr/>
		</div>
		<div class="clear"></div>
		<script type="text/javascript">
			$(document).ready(function(){
				$( '.suggestion_day{{$suggestion_day}}' ).click(function() {
				  $( ".suggestion_list{{$suggestion_day}}" ).toggle( "slow");
				});
			});
		</script>
        @endforeach
	</div>
	
	<div class="clear"></div>
	<br>
	<br>
	<br>
	<br><br><br>
@stop