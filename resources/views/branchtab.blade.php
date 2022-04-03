@extends('DashPlate')

@section('title')
   Loyalty APP
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Branch Office Settings
@stop

@section('content')

	<div class="row page_sub">
		Add Branch
	</div>
	<div class="row branch_subdesc">
    Input location details and administrative officer of designated branch
  	</div>
  	<div class="col-md-10"><hr/></div>
  	<div class="clear"></div>
	<!--error log-->
	<div style="color:red;">
		@foreach ($errors->all() as $error)
		    <p>Error {{$error or ''}}</p>
		@endforeach
	</div>
	<div class"col-md-12 branch_option">
		<form action="branch/add" method="post">
			
			
				<label for="input" class="col-md-2 branch_label">Branch:</label>
				<div class="col-md-4 branch_location">
					
					<input type="text" name="Branch_Location" class="form-control"   value="">
				</div>
			
			<div class="clear"></div>
			
			
				<label for="input" class="col-md-2 branch_label">City:</label>
				<div class="col-md-4 branch_location">
				
					<input type="text" name="Branch_City" class="form-control"  value="">
				</div>
			
			<div class="clear"></div>
			
			<label for="input" class="col-md-2 branch_label"></label>
			<div class="col-md-4 manager">
				<select class="form-control" name="Branch_Manager">
					<option value=" "disabled selected>Select assigned manager/officer</option>
				  	@foreach ($managers as $manager)
					   <option value="{{$manager->facebook_id}}">{{$manager->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2 branch_location">
				<input class="btn btn-info button_add" type="submit" value="Add to list">
			</div>
		</form>
		<div class="clear"></div>
		<br>
			<?php if(null !== session('branch_id')){ ?>
			<div class="alert alert-danger" role="alert">
			  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			  <span class="sr-only">Error:</span>
			  {{session('branch_name')}} has been Deleted.<br/>
			  do you want to <a href="branch/restore/{{session('branch_id')}}" style="color:#337ab7; text-decoration: underline;">Restore</a>?
			</div>
			<?php } ?>
		<br>
		<div class="col-md-10 Manager_location_list">
			 <table class="table">
	            <tr> 
	              <th  class="row branch_field"></th>
	              <th  class="row branch_field">Location</th>
	              <th  class="row branch_field">No. of Members</th>
	              <th  class="row branch_field">Manager</th>
	            </tr>
	            @foreach ($Branch_list as $Branch)
            	<tr>
					<td class="row tablerecord">
						<a href="branch/delete/{{$Branch->id}}">
					    	<span class="glyphicon glyphicon-minus-sign remove" aria-hidden="true"></span>
					  	</a>
					</td>
					<td class="row tablerecord">
						<a href="{{url()}}/branch/branchMembers/{{$Branch->id}}" style="color:blue;" />
							{{$Branch->branch_name}}, {{$Branch->city}}
						</a>
						
					</td>
					<td class="row badge_members">
						<span class="row badge"> 
							{{$Branch->member_count}}
						</span>	
					</td>                       
					<td class="row tablerecord">{{$Branch->user->name or 'No Manager'}}</td>
            	</tr>
				@endforeach
             </table>
		</div>

@stop