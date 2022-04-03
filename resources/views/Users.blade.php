@extends('DashPlate')

@section('title')
   User Profile
@stop

@section('page htag')
   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;Manage Users
@stop

@section('content')
<div>
	<br>
  @if (null !== session('user_name'))
    <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{session('user_name')}} has been Deleted.<br>
    do you want to <a href="dashboard/restore/{{session('facebook_id')}}" style="color:#337ab7; text-decoration: underline;">Restore</a>?
    </div>
  @endif

  <br><br>
</div>
<div class="col-md-10 manageusers_desc"><p> Click on user's name to view facebook profile.</div>
<div class="clear"></div>
<div class="col-md-10"><hr/></div>
<div class="clear"></div>


<div class="row LIST">
  <div class="row tablee">
    
      
        <table class="table">
                <tr>
                  <th colspan="5" class="row titlename"><p>User List</p></th>
                </tr>
               
                <tr>
                  <th class="row user_name "></th>
                  <th class="row user_name">Name</th>
                  <th  class="row user_name ">Points</th>
                  <th  class="row user_name ">Tracking No.</th>
                  <th  class="row user_name ">Role</th>
                </tr>
                   @foreach ($users as $user)
                <tr>
                    <td class="row tablerecord">
                      <a href="dashboard/delete/ {{$user->facebook_id}} ">
                        <span class="glyphicon glyphicon-minus-sign remove" aria-hidden="true"></span>
                      </a>
                    </td>
                    <td class="row tablerecord "><a href="https://www.facebook.com/{{$user->facebook_id}}" target="_blank" class="name_record">{{ $user->name }}</a></td>
                    <td class="row tablerecord"><span class="badge">{{ $user->points }}</span></td>
                    <td class="row tablerecord">#35353634</td>
                    <td class="row tablerecord">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              
                              @if ($user->user_type == 'xuser')
                                Pending User
                              @elseif ($user->user_type == 'user')
                                Approved User
                              @elseif ($user->user_type == 'xxuser')
                                Rejected User
                              @else
                                {{$user->user_type}}
                              @endif
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              @foreach ($usertypes as $usertype)
                                  <li><a href="dashboard/change-user-type/{{$user->facebook_id}}/{{$usertype}}">
                                    @if ($usertype == 'xuser')
                                      Pending User
                                    @elseif ($usertype == 'user')
                                      Approved User
                                    @elseif ($usertype == 'xxuser')
                                      Rejected User
                                    @else
                                      {{$usertype}}
                                    @endif
                                  </a></li>
                              @endforeach
                            </ul>
                          </div>
                    </td>
                </tr>
                  @endforeach 
                 
        </table> 
      
    </tr>  
  </div> 
</div>

  
@stop