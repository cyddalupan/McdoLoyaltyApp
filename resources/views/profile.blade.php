@extends('template')

@section('page_title')
   Loyalty APP User
@stop

@section('content')

@include('feedback_lightbox')
@include('slider_lightbox')

<div class="clear"></div>

<div id="Profile">
	<div class="col-xs-12 header_user whats_new"><img src="{{url()}}/public/IMG/sapphire_round.png" height="30px" width="30px" class="row bluepantone">&nbsp;&nbsp;&nbsp;ALPHA 245</div>
	<div class="clear"></div>
	
	<div class="row user_sidebar">
			<div class="col-xs-3 profile_col shadow_sidecol">


				
					<!--<div class="col-xs-12 mcphoto">
						<div class="col-xs-12 mcphotoplate"><img src="https://graph.facebook.com/{{$userInfo->facebook_id}}/picture?type=large" class="pic" height="150px" width="150px"/></div>
					</div>-->
				<div class="col-xs-12 name"><b>{{$userInfo->name}}</b></div>
				<div class="col-xs-12 location_age">
													<br>{{$userInfo->gender}}, {{$age}}</div>
				<div class="clear"></div>
				<div class="row borderbottom"></div>
				
				<div class="col-xs-12 workinfo_label"><b>Work Info</b></div>
				<div class="col-xs-12 branch_details">{{$UserBranch->branch_name or 'Please Select branch'}},<br>{{$UserBranch->city or ''}}</div>
				<div class="row borderbottom"></div>

				<div class="clear"></div>

				<div class="col-xs-12 onoff">
		     		<p>
		     			<br>
		     			
		     				Activate Scheduled <br/> Post?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							@if($userInfo->post_to_my_wall == "yes")
								<input type="checkbox" checked data-toggle="toggle" data-size="mini" data-onstyle="success" class="toggle_onoff">
							@else
								<input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" class="toggle_onoff">
							@endif
   					</p>
				</div>


				<div class="clear"></div>
				<div class="row borderbottom"></div>
				@if(($userInfo->user_type == 'admin') || ($userInfo->user_type == 'branchManager'))
				<div class="col-xs-12 pagerole"><b>Page Role</b></div>
				<div class="row backtoAdmin">
					@if($userInfo->user_type == 'admin')
					<a href="{{url()}}/dashboard" target="_blank">
						<div class="col-xs-12 admin_button">Admin Page</div>
					</a>
					@elseif($userInfo->user_type == 'branchManager')
					<a href="{{url()}}/manager-admin/{{$userInfo->facebook_id}}" target="_blank">
						<div class="col-xs-12 pending_button">Manager's Board&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">{{$pending_count}}</span></div>
					</a>
					@else
							<div style="height:95px;"></div>
					@endif
				</div>
				@endif
				<br>
				<br>		
				@if (($userInfo->user_type != 'xuser') && ($userInfo->user_type != 'xxuser') )
				<div class="col-xs-12 recordpoints">
						<div class="row num_rec num_point"><img src="{{url()}}/public/IMG/loading.gif" width="25px" height="25px" ></div>
							<br><p class="row post earned_points">Earned Points</p>
							<small><a href="prizes" class="see_prizes" target="_blank">See prizes.</a></small>
				</div>
				@endif
					<div class="col-xs-12 update update_button">
						<button type="button" id="myButton" data-loading-text="Loading..." class="btn btn-primary cyd-update-points" autocomplete="off"
							data-size="mini">
								  Update Points 
						</button>

						<script>
					        $('#myButton').on('click', function () {
								var $btn = $(this).button('loading')
								// business logic...
								$btn.button('reset')
								})
						</script>
					</div>
					<div class="clear"></div>
					<div class="row borderbottom"></div>
						<div class="col-xs-12 feedback">
							<div class="col-xs-12 title_feedback"><b>Send us your feedback</b></div>
							<div class="col-xs-12 copy_feedback"> Let us know how we're doing as we continually 
																improve our work!</div>	
							<div class="col-xs-12 message_us">Click here!</div>									
						</div>
					<div class="row borderbottom"></div>	
					<div class="clear"></div>				

			</div>
			@if(
				$userInfo->user_type == 'xuser' || 
				$userInfo->user_type == 'xxuser' ||
				(
					$userInfo->user_type == 'admin' &&
					$userInfo->branch_id == 0
				)
			)
			   @include('home_select_branch')
			@else
				@include('home_slider')
			@endif

			<div class="row col-xs-9 newsfeed_header">Recent Updates </div>

			<div class="row col-xs-9 newsfeed shadow">
				@if(count($onGoingEvents) < 1)
					No Events Yet.
				@endif

				<?php 
					$onGoingEventcount = 0; 
					$initCount = 5;
				?>
				@foreach ($onGoingEvents as $onGoingEvent)
				<?php $onGoingEventcount++; ?>
				<div class="clear"></div>
				<div class="col-xs-12 feed_placement">
					<div class="row per_event 
					@if($onGoingEventcount > $initCount)
						per_event_hidden
					@endif
					">
						<div class="col-xs-3 logo_title">
							<img src="{{$onGoingEvent->logo}}" class="img-responsive logoclass" 
						 	alt="Responsive image" width="65px" height="65px"/>
						</div>
						<div class="col-xs-9 copytitle">{{$onGoingEvent->title}}</div>
						
						<div class="clear"></div>
						<div class="col-xs-9 hr_feed"></div>
						<div class="col-xs-9 timedate_feed">{{$onGoingEvent->cyd_time}}</div>
						<div class="clear"></div>
						<div class="col-xs-8 image_placement">
							<img src="{{$onGoingEvent->img}}" class="imagefeed_size">
						</div>
						<div class="clear"></div>
						<div class="col-xs-8 copy_ad">
								<p>{!! $onGoingEvent->description !!}</p>
						</div>
						
						@if ($onGoingEvent->shareable == 1)
						<div class="col-xs-12 keywords_display"><b>Available keywords:</b><i> 
							{{$settingArr['find_word'] or ''}}, 
							{{$settingArr['find_word_2'] or ''}}, 
							{{$settingArr['find_word_3'] or ''}}, 
							{{$settingArr['find_word_4'] or ''}}, 
							{{$settingArr['find_word_5'] or ''}}, 
						</i></div>
						<div class="col-xs-2 fbshare">
							<div class="fb-share-button" data-href="{{$onGoingEvent->sharelink}}" data-layout="button" class="img-responsive share"></div>
						</div>
						@endif
						<div class="clear"></div>
					</div>
			    </div>
				@endforeach
			    @if($onGoingEventcount > $initCount)
					<button class="btn btn-default cyd_view_more" type="submit">View More</button>
				@endif	
			</div>
	</div>	
</div>

@if(count($upcomingEvents) < 1)
	<style type="text/css">
		.ad_slider{display: none !important;}
	</style>
@endif


<script src="{{url()}}/resources/assets/slippery/dist/slippry.min.js"></script>
<link rel="stylesheet" href="{{url()}}/resources/assets/slippery/dist/slippry.css" />

<!-- bxSlider Javascript file -->
<script src="{{url()}}/resources/assets/mcslider/jquery.bxslider.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
  		$('.bxslider').bxSlider();
	});
</script>
<!--facebook JS-->
<script type="text/javascript">
	//declare app_id
	var cyd_app_id = {{$app_id}};
	var public_url = "{{url()}}/";
	var me_fb_id = {{$userInfo->facebook_id}};
	var userPoints = {{$userInfo->points}};
	var userRewards = {{$userInfo->rewards}};
	var userTotalPost = {{$post_count}};
	var switch_point = {{$settingArr['posttowall_points']}};
	var totaladdpoints = {{$totaladdpoints}};
</script>

<!--post to wall slider data sender-->
<script src="{{url()}}/public/js/slider_data_sender.js"></script>
@stop