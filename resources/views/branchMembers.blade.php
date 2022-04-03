@extends('DashPlate')

@section('title')
   Branch Members
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Branch Members
@stop

@section('content')


<div class="row BranchMembers">

	
	
	
	<div class="col-md-9 Branch_name"> 
	<p>{{$branch->branch_name}}</p>
	
	</div>
	<div class="col-md-9 Branch_city"> 
	<p>{{$branch->city}}</p>
	
	</div>
	<div class="col-md-9 Branch_managersname"> 
		<p><b>General Manager: </b>{{$manager->name}}<p>
		
	</div>
	
	<div class="clear"></div>
	<div class="col-md-9 hr_branch">
	<hr>
	</div>
	<div class="clear"></div>
	
	
	<div class="col-md-7 Branch_memberslist">
			 <table class="table">
	            <tr> 
	              <th  class="row branch_field">Branch Members</th>
	              <th  class="row branch_field">Points</th>
	            </tr>
	            @foreach ($members as $member)
            	<tr>
					<td class="row branch_listrecord">
						<a href="https://www.facebook.com/{{$member->facebook_id}}"target="_blank" class="branch_ahref">{{$member->name}}</a>
						 [<a href="{{$member->link_to_user_post}}" class="branch_ahref" />View Posts</a>]
					</td>
					
					<td class="row branch_listrecord">
						<span class="row badge"> 
							{{$member->points}}
						</span>	
						
					</td>
            	</tr>
		@endforeach
             </table>
		</div>





<div>
@stop