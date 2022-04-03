@extends('DashPlate')

@section('title')
   User Post
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;User Posts
@stop

@section('content')
<div class="row BranchMembers">
	
		<div class="col-md-10 name_posts ">{{$user->name}}</div>
		<div class="clear"></div>
<div class="col-md-10"><hr/></div>

	
<div class="clear"></div>	
<div class="col-md-10 postfilter_title"><p>Approved Posts</p></div>
<div class="clear"></div>

	
<div class="col-md-7 filterwords_table">
	 <table class="table">
		<tr>
			<td class="postfilter_subtitle">
				Approved Posts
			</td>
			<td class="postfilter_subtitle">
				Likes
			</td>
			<td class="postfilter_subtitle">
				Comment
			</td>
			<td class="postfilter_subtitle">
				Keyword
			</td>
		</tr>
		@foreach($good_posts as $good_post)
		<tr>
			<td class="postfilter_content">
				{{$good_post->message}}
			</td>
			<td class="postfilter_content">
				{{$good_post->likes}}
			</td>
			<td class="postfilter_content">
				{{$good_post->comment_count}}
			</td>
			<td class="postfilter_content">
				{{$good_post->keyword}}
			</td>
		</tr>
		@endforeach
	</table>
	
	
</div>
<div class="clear"></div>
<div class="col-md-10 postfilter_title"><p>Indeecent Posts</p></div>
<div class="clear"></div>

<div class="col-md-7 filterwords_table">	
	 <table class="table">

		<tr>
			<td class="postfilter_subtitle">
				Indecent posts
			</td>
			<td class="postfilter_subtitle">
				Likes
			</td>
			<td class="postfilter_subtitle">
				Comment
			</td>
			
		</tr>
		@foreach($bad_posts as $bad_post)
		<tr>
			<td  class="postfilter_content">
				{{$bad_post->message}}
			</td>
			<td  class="postfilter_content">
				{{$bad_post->likes}}
			</td>
			<td  class="postfilter_content">
				{{$bad_post->comment_count}}
			</td>
			
		</tr>
		@endforeach
	</table>
</div>
</div>
@stop