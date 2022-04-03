<!--Slider -->
<div class="col-xs-9 ad_slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			@for ($e = 0; $e < count($upcomingEvents); $e++)
				<li data-target="#carousel-example-generic" 
				data-slide-to="{{$e}}" 
				<?php if ($e == 0){ ?>
					class="active"
				<?php } ?>
				></li>
			@endfor
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			@foreach ($upcomingEvents as $upcomingEvent)
				<div class="item <?php if(!isset($active)){ $active = 1; echo "active";} ?> uplight" event-id="{{$upcomingEvent->id}}">
					<img src="{{url()}}/public/event_img/{{$upcomingEvent->img}}" width="622px" height="290px">
					<div class="carousel-caption slider_caption">
						{{$upcomingEvent->title}}
					</div>
				</div>
			@endforeach
		</div>

		<!-- Controls -->
		<a class="left carousel-control slider_control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control slider_control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>