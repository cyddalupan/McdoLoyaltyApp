<div class="row header_request"><b>Branch  Event</b></div>
<div class="row pending_subdesc"><b>Post a Closed Event for Your Branch</b></div>
<div class="row create_event" style="padding-top:10px">
    <a href="{{url()}}/manager-admin/add-event/{{$manager_id}}" style="color: rgb(21, 53, 136); ">
        <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true">
        </span>
        &nbsp;&nbsp;Create Event
    </a>
</div>
<div class="row back_prflebutton"></div>
@foreach ($events as $event)
<div class="row request_placement">
    <h1>{{$event->title}}</h1>
    <h5>{{$event->event_date_formated}}</h5>
    <img src="{{url()}}/public/event_img/{{$event->img}}" width="200px" />
    <h4>{{$event->event_category}}</h4>
    <p>{{$event->description_shortened}}...</p>

	
		<div class="col-md-7 pending_branchbuttons">
		 <a href="">
		    <form method="post" action="{{url()}}/manager-admin/edit/{{$manager_id}}">
		        <input type="hidden" name="event_id" value="{{$event->id}}" />
		        <input type="hidden" name="title" value="{{$event->title}}" />
		        <input type="hidden" name="description" value="{{$event->description}}" />
		        <input type="hidden" name="publishdate" value="{{$event->event_date_raw}}" />
		        <input type="hidden" name="event_category" value="{{$event->event_category_id}}" />
		        <input type="hidden" name="add_share_button" value="{{$event->shareable}}" />
		        <input type="hidden" name="img" value="{{$event->img}}" />
		        <button type="submit" class="btn btn-primary" style="float:right;">
		          <span class="glyphicon glyphicon-wrench" aria-hidden="true">
		          Edit
		        </button>
		    </form></a>
		  
		     <a href="{{url()}}/manager-admin/delete/{{$event->id}}" 
		        onclick="return confirm('Are you sure you want to Remove {{$event->title}}?');" 
		        class="btn btn-danger event_delete">
		      <span class="glyphicon glyphicon-trash" aria-hidden="true">
		      Delete
		    </a>
		
	  	</div>
</div>
@endforeach