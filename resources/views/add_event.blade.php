@extends('template')

@section('page_title')
  Pending
@stop

@section('content')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{url()}}/public/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="{{url()}}/public/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="{{url()}}/public/css/Pending.css">

<div class="col-xs-12 image_loyalty">
    <img src="{{url()}}/public/IMG/Alpha_logo.png" height="140px" width="140px">
</div>
<div class="col-xs-12 header_title">
    <div class="row Loyaltytitle_pending">Loyalty App</div>
</div>
<div class="col-xs-12 copy_eventbranch">Create a new event for your branch</div>
<div class="col-xs-3 "></div>
<div class="col-xs-6 borderbottom_divider "></div>
<div class="col-xs-3"></div>
  <div class="clear"></div>

<br>
<br>
<div id="add-branch-event">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="{{url()}}/submit-event" method="post" enctype="multipart/form-data">
            <input type="hidden" name="manager_id" value="{{$manager_id}}">
            <input type="hidden" name="event_id" value="{{$old['event_id'] or ''}}">
            <div class="clear"></div>
             <div class="form-group">
                <label for="input" class="col-xs-2 title_editor"></label>
                <div class="col-xs-9">
                    @foreach ($errors->all() as $error)
                        <p style="color:red;">*{{$error or ''}}</p>
                    @endforeach
                    {{session('message') or ''}}
                </div>
            </div>
            <div class="clear"></div>
            <div class="form-group">
                <label for="input" class="col-xs-2 title_editor">Title</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" name="title"  placeholder="Title"  value="{{$old['title'] or ''}}">
                </div>
            </div>
            <br>
            <br>
            <div class="form-group" style="text-align:left;">
                <label for="input" class="col-xs-2 title_editor">Description</label>
                <div class="col-xs-9">
                <div style="background:#fff; color:black;">
                    <textarea class="form-control" name="description" rows="8" placeholder="textarea">{{$old['description'] or ''}}</textarea>
                </div>
            </div>
            <div class="clear"></div>
            
            <div class="clear"></div>
            <div class="col-xs-9" style="display:none;">
            <br>
            <label for="input" class="col-xs-2 title_editor">Event Type</label>
                <select class="form-control" name="event_category">
                    @foreach ($event_categories as $event_category)
                        <option 
                            value="{{$event_category->id}}"
                            @if (isset($old['event_category']) &&  $old['event_category'] == $event_category->id)
                                selected="selected"
                            @endif
                        >
                            {{$event_category->category}}
                        </option>
                    @endforeach
                </select>
            <div class="clear"></div>
            </div>

            <div class="form-group" style="text-align:left; padding: 35px 0;">
                <label for="input" class="col-xs-2 title_editor">Add Share Button?</label>
                <div class="col-xs-9">
                    <label class="radio-inline">
                        <input type="radio" name="add_share_button" id="inlineRadio1" value="1" 
                            @if (isset($old['add_share_button']) )
                                @if($old['add_share_button'] == 1)
                                    checked
                                @endif
                            @else
                                checked
                            @endif
                        >Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="add_share_button" id="inlineRadio2" value="0"
                        @if (isset($old['add_share_button']) && $old['add_share_button'] == 0)
                            checked
                        @endif
                        >No
                    </label>
                </div>
            </div>

            <div class="clear"></div>

            <div class="form-group">
                <label for="input" class="col-xs-2 title_editor ">Image</label>
                <div class="col-xs-9">
                 <div class="col-xs-8 Image_upload_upcoming">

                    @if(isset($old['img']))
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
                        <iframe src="{{url()}}/events/change_image/{{$old['event_id']}}"  width="100%" height="200px" id="change_image" marginheight="0" frameborder="0" onLoad="autoResize('change_image');"></iframe>
                    @else
                        Select image to upload:
                        <input type="file" name="photo" id="post_image_upload" value="">
                        <p class="help-block note_event">Select File to upload. Photo must be 622px by 314px</p>
                    @endif
                </div>
            </div>
            <br>
            <div class="clear"></div>
            <label for="input" class="col-xs-2 title_editor">Publish Date</label>
            <div class="col-xs-9">
                <input type="text" class="form-control span2 datepicker" style="color:black;" name="publishdate" value="{{$old['publishdate'] or ''}}" id="dpd1">
            </div>
            <div class="clear"></div>

            <div class="form-group">
                <div class="form-group">
                    <label for="input" class="col-xs-2 title_editor"></label>
                    <div class="col-xs-9">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-send" aria-hidden="true"></span> 
                            Submit
                        </button>
                        <a href="{{url()}}/manager-admin/{{$manager_id}}" onclick="return confirm('Are you sure you want to go back! Event is not yet Saved');">
                            <button type="button" class="btn btn-info">
                                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> 
                                Back
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
    <div class="clear"></div>
</div>

<br><br><br><br>

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