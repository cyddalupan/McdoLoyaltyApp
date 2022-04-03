@extends('DashPlate')

@section('title')
   Loyalty APP
@stop

@section('page htag')
<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;&nbsp;Upcoming Events
@stop

@section('content')

<div class="row page_sub">
   Calendar of Events
  </div>
  <div class="row event"></div>
   <div class="row branch_subdesc">
    Input upcoming event details
  </div>
   <div class="row branch_subdesc">
    All created events are publish internaly 
  </div>
  <div class="col-md-9"><hr/></div>
  <div class="clear"></div>
  <div class="col-md-9 create_event">
    <a href="new-event" class="event_createnew"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Create Event</a>
  </div>
  <div class="clear"></div>
  <br>
  @if (null !== session('event_id'))
    <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{session('event_title')}} has been Deleted.<br>
    do you want to <a href="events/restore/{{session('event_id')}}" style="color:#337ab7; text-decoration: underline;">Restore</a>?
    </div>
  @endif
  <br>

<div class="col-md-9 evets_table">
  <div class="col-md-2 event_field">
    <span class="glyphicon glyphicon-calendar" aria-hidden="true">
    Date
  </div>
  <div class="col-md-10 event_field">Event</div>
  @foreach ($events as $event)
    <div class="row event_list">
      <div class="col-md-2 date_temp ">
        <div class="row date_placement">
            <div class="panel panel-danger">
              <div class="panel-heading date_label">{{date('M',strtotime($event->event_date))}}</div>
              <div class="panel-body date_label">
                <h3>{{date('d',strtotime($event->event_date))}}</h3>
              </div>
          </div>
        </div>
      </div> 
     
      <div class="col-md-9 event_body">

        <div class="row col-md-12 event_title">{{$event->title}}</div>
        <div class="row col-md-9 event_desc">{{substr(strip_tags($event->description), 0,100)}}...</div>
        <div class="row col-md-9 event_desc">
        </div>
        <a href="events/delete/{{$event->id}}" class="btn btn-danger event_delete">
          <span class="glyphicon glyphicon-trash" aria-hidden="true">
          Delete
        </a>
        <a href="events/edit/{{$event->id}}" class="btn btn-primary" style="float:right;">
          <span class="glyphicon glyphicon-wrench" aria-hidden="true">
          Edit
        </a>
      </div>
    </div>
  @endforeach
</div>
   

@stop