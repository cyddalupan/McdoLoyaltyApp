@extends('template')

@section('page_title')
	Home
@stop

@section('content')
<div id="home">

   	<div class="row copy">
	 <div class="col-md-2"></div>
		 <div class="col-md-12 title_app">Loyalty APP</div>
		
		 <div class="col-md-12 title_app_subtitle">Lorem ipsum dolor sit amet.</div>
		 <div class="clear "></div>
		 
		 
		 
		  <div class="col-md-12 join_bot">

			<h2 class="Thank fb_joined">
				Please Wait...
				<img src="{{url()}}/public/IMG/loading.gif" width="25px" height="25px" >
			</h2>
			<div class="col-md-12 join_button"><p class="join_me_in  notYetJoin">JOIN</p>
				<!--<img src="public/IMG/join.png" class="img-responsive join_me_in  notYetJoin" 
			alt="Responsive image" width="100px" height="100px">-->
			</div>
		</div>
		<div class="clear "></div>
		  

		<div class="col-md-1 p5 "> </div>
		<div class="col-md-10 p5 start notYetJoin">Join now and start collecting points today</div>
		<div class="col-md-1 p5 "> </div>
		
		<div class="clear "></div>

		<div class="col-md-2 p2"></div>
		 <div class="col-md-8 p2"> Lorem ipsum dolor sit amet, 
		 	consectetur adipiscing elit. Nulla ante dui, interdum quis leo ac, 
		 	ultrices malesuada felis.
		 	<br>
		 	<br>
		    Nulla sem purus, sagittis eu euismod sed, 
		 	scelerisque elementum dui.
		 	<br>
		 	<br>
		 
		 </div>
		 <div class="col-md-2 p2"></div>
		 <br>

		  <div class="clear "></div>
		  
		  
		 

		
		
	
		
		<div class="p7 termsC1">See APP mechanics & Conditions</div>
		<!--<div class="p7 termsC">See APP mechanics & Conditions</div>-->
		<div class="clear "></div>   
		

	
	</div>
	@include('TermsContent')
	<div class="yellow-bg"></div>
</div>
<script type="text/javascript">
	//declare app_id
	var cyd_app_id = <?php echo $app_id; ?>;
	var public_url = "{{url()}}/";
</script><!--Switches-->

@stop				