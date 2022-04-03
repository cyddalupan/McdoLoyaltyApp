@extends('DashPlate')

@section('title')
   Loyalty APP
@stop

@section('page htag')
<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>&nbsp;&nbsp;Create New Event
@stop

@section('content') 
<br>
<!-- wysihtml5 parser rules -->
<div class="row branch_subdesc">
    Input upcoming event details
</div>
<div class="col-md-10"><hr/></div>
<div class="clear"></div>

<form action="{{url()}}/new-event/insert" method="post" enctype="multipart/form-data">
    <input type="hidden" name="event_id" value="{{$event->id or ''}}">
    <div class="clear"></div>
     <div class="form-group">
        <label for="input" class="col-sm-2 title_editor"></label>
        <div class="col-sm-6">
            @foreach ($errors->all() as $error)
                <p style="color:red;">*{{$error or ''}}</p>
            @endforeach
        </div>
    </div>
    <div class="clear"></div>
 	<div class="form-group">
        <label for="input" class="col-sm-2 title_editor">Event title</label>
        <div class="col-sm-6">
        	<input type="text" class="form-control" name="title"  placeholder="Title"  value="{{$old['title'] or ''}}{{$event->title or ''}}">
        </div>
    </div>
    <br>
    <br>
  	<div class="form-group">
        <label for="input" class="col-sm-2 title_editor ">Description</label>
        <div class="col-sm-6">
        <div style="background:#fff; color:black;">
            <textarea class="form-control" name="description" rows="8" placeholder="textarea">{{$old['description'] or ''}}{{$event->description or ''}}</textarea>
        </div>
    </div>
    <div class="clear"></div>
    <br>
    
   
    <div class="clear"></div>
        <label for="input" class="col-sm-2 title_editor">Publish Date</label>
        <div class="col-md-6">
            <input type="text" class="form-control span2 datepicker" style="color:black;" name="publishdate" value="{{$old['publishdate'] or ''}}{{$event->event_date or ''}}" id="dpd1">
        </div>
    <div class="clear"></div>
    <br>
    <div class="clear"></div>
    <div class="form-group">
        <label for="input" class="col-sm-2 title_editor ">Image</label>
        <div class="col-sm-6">
         <div class="col-sm-8 Image_upload_upcoming">

            @if(isset($event->img))
                <script language="JavaScript">
                <!--
                function autoResize(id){
                    var newheight;
                    var newwidth;

                    if(document.getElementById){
                        newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
                        newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
                    }

                    document.getElementById(id).height= (newheight) + "px";
                    document.getElementById(id).width= (newwidth) + "px";
                }
                //-->
                </script>
                <iframe src="{{url()}}/events/change_image/{{$event->id}}"  width="100%" height="200px" id="change_image" marginheight="0" frameborder="0" onLoad="autoResize('change_image');"></iframe>
            @else
                Select image to upload:
                <input type="file" name="photo" id="post_image_upload" value="{{$old['photo'] or ''}}">
                <p class="help-block note_event">Select File to upload. Photo must be <b>622px</b> by <b>314px</b></p>
            @endif
        </div>
    </div>
    <div class="clear"></div>
    <div class="col-md-6 select_branch_post">Include any branch in posting:</div>
    <div class="clear"></div>
    @include('select_branch')
    <div class="form-group">
        <div class="form-group">
            <label for="input" class="col-sm-2 title_editor"></label>
            <div class="col-md-9">
            <hr/>
            <input type="submit" class="btn btn-primary" value="Submit Event"/>
            </div>
        </div>
    </div>
</form>

<div class="clear"></div>

<!--date picker-->
<script src="{{url()}}/resources/assets/datepicker2/js/bootstrap-datepicker.js" type="text/javascript"></script>
<link rel="stylesheet/less" type="text/css" href="{{url()}}/resources/assets/datepicker2/css/datepicker.css" />
<script type="text/javascript">
$('.datepicker').datepicker();
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 

$('#dpd1').on('changeDate', function() {
  $('.dropdown-menu').hide();
});
</script>


<!--text editor-->
{{--
<script src="{{url()}}/resources/assets/nice-edit/nice.js" type="text/javascript"></script>
--}}
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>


@stop