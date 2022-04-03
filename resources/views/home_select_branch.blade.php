<div class="jumbotron light_select_branch" style=" height:314px; margin-bottom: 0;">
 <form action="user/select-branch" method="post">
	<h3>Select Branch</h1>
	<p>Please Select Branch to view Upcoming Events</p>
	<p class="alert-success">{{session('message')}}</p>
	<p class="alert-danger">{{$errors->first('branch')}}</p>
	<input type="hidden" name="facebook_id" value="{{$userInfo->facebook_id}}" />
	<select class="form-control" name="branch" placeholder="Select Branch" style="width: 50%; margin: auto;">
		<option value="{{$userInfo->branch_id}}">{{$UserBranch->branch_name or 'Please Select branch'}}</option>
		@foreach ($branches as $branch)
			<option value="{{$branch->id}}">{{$branch->branch_name}}</option>
		@endforeach
	</select>
	<input type="submit" class="btn btn-primary btn-lg" style="margin-top: 17px;" role="button" value="Submit">
  </form>
</div>
<div class="select_branch_black"></div>
<style type="text/css">
	.light_select_branch{
		position: absolute;
		top: 135px;
		left: 0px;
		right: 0px;
		margin: auto;
		z-index: 11;
		width: 600px;
	}

	.select_branch_black{
	  z-index: 10;
	  right: 0;
	  left: 0;
	  top: 0;
	  bottom: 0;
	  margin: auto;
	  position: fixed;
	  background-image: url("{{url()}}/public/IMG/black_small.png");
	}

	.alert-success{
		font-size: 17px !important;
	}
</style>