
<div class="row header_request"><b>Pending    Requests</b></div>
<div class="row pending_subdesc"><b>employees of McDonald's Corporation are entitled to join the App</b></div>
<div class="row back_prflebutton" style="padding-bottom: 54px;"></div>
@foreach ($pendingUsers as $pendingUser)
<div class="row request_placement">
    <div class="col-xs-2 image_req">
        <img src="https://graph.facebook.com/{{$pendingUser->facebook_id}}/picture?type=large" width="100px" height="100px">
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-7 pending_name">
        <p>
            <strong>
                <a href="https://facebook.com/{{$pendingUser->facebook_id}}" class="pending_name">
                    {{$pendingUser->name}}
                </a>
            </strong>
            <br>
            employee of the company?
        </p>
    </div>
    <div class="row">
        <div class="col-xs-12 option_request">
            <a class="btn btn-success" href="yes-accept-user/{{$pendingUser->facebook_id}}/{{$manager_id}}">Confirm</a>
            <a class="btn btn-danger" href="not-on-my-branch/{{$pendingUser->facebook_id}}/{{$manager_id}}" onclick="return confirm('Are you sure you want to Decline {{$pendingUser->name}}?');">Decline</a>
        </div>
    </div>
</div>
<br>
@endforeach
<div class="clear"></div>
<br/>
<div class="row header_request"><b>Your Members</b></div>

@foreach ($approvedUsers as $approvedUser)
    <div class="row request_placement">
        <div class="col-xs-2 image_req">
            <img src="https://graph.facebook.com/{{$approvedUser->facebook_id}}/picture?type=large" width="100px" height="100px">
        </div>
        <div class="col-xs-1">
        </div>
        <div class="col-xs-5 pending_name">
            <p>
                <strong>
                    <a href="https://facebook.com/{{$approvedUser->facebook_id}}" class="pending_name">
                        {{$approvedUser->name}}
                    </a>
                </strong>
                <br>
                employee of the company?
            </p>
        </div>
        <div class="col-xs-1 option_request">
            <button type="button" class="btn btn-warning">
                <a href="not-on-my-branch/{{$approvedUser->facebook_id}}/{{$manager_id}}" onclick="return confirm('Are you sure you want to Remove {{$approvedUser->name}}?');">
                    Remove
                </a>
            </button>
        </div>
    </div>
    <br>
@endforeach