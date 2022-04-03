@extends('DashPlate')

@section('title')
   Add Points
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Add Points to Users
@stop

@section('content')
	
	<div class="row addpoints_input">
		
		<div class="col-md-10">
			<form action="{{url()}}/add-points/store" method="post">
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="Points">Points</label>
						<input type="text" class="form-control" id="Points" placeholder="Enter Points" name="points">
					</div>
				</div>
				<div class="clear"></div>

				<div class="col-md-6">
						<div class="form-group">
						<label for="Points">User</label>
						
						<select class="form-control" name="user_id">
						  	<option></option>
						  	@foreach ($users as $user)
						  		<option value="{{$user->facebook_id}}">{{$user->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="col-md-6 Submit_editpoints">
					<input class="btn btn-default" type="submit" value="Submit">
				</div>
				<div class="clear"></div>

				<div class="col-md-10 erroraddpoints_log">
					@foreach ($errors->all() as $error)
                       <p style="color:#a00e0e;">*{{$error or ''}}</p>
                   @endforeach
                </div>



				<div class="clear"></div>
			</form>
			<div class="col-md-10 div_addpoints"></div>
			<div class="clear"></div>
		
			<div class="col-md-10 Log_subtitle">LOG Files</div>

			<div class="col-md-10 logaddpoints_table">
				<table class="table">
					<tr> 
						<th  class="row branch_field">Name</th>
						<th  class="row branch_field">Added Points</th>
						<th class="row branch_field">Date Created</th>
						<th class="row branch_field">Points Added by</th>
					</tr>
					@foreach ($points as $point)
					<tr>
						<td class="row tablerecord">
							{{ $point->user_name }}
						</td>
						<td class="row tablerecord">
							{{ $point->points }}
						</td>
						<td class="row tablerecord">
							{{ $point->created_at }}
						</td>
						<td class="row tablerecord">
							{{ $point->admin_name }}
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@stop