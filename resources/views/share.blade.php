@extends('DashPlate')

@section('title')
   Loyalty APP
@stop

@section('page htag')
<span class="glyphicon glyphicon-share" aria-hidden="true"></span>&nbsp;&nbsp;Post to wall
@stop

@section('content')

  <div class="row page_sub">
    Update Post 
  </div>
   <div class="row branch_subdesc">
     Edit details below before posting
  </div>
	<div class="col-md-10"><hr/></div>	

  <div class="clear"></div>
  <style type="text/css">
  .quick_settings{
    width: 874px;
    float: left;
    margin-left: 44px;
    border: none;
    height: 108px;
  }
  </style>
  <iframe class="quick_settings" src="{{url()}}/editor/quick_settings"></iframe>
  <div class="clear"></div>
  <div class="row form_post">
    <form action="share" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="input" class="col-sm-1 lab1 ">Facebook Message</label>
        <div class="col-sm-8">
         <textarea class="form-control" name="p_mess" rows="3"placeholder="Message"></textarea>
        </div>
      </div>
      <div class="clear"></div>
      <div class="form-group">
        <label for="input" class="col-sm-1 lab1">Image</label>
        <div class="col-sm-8">
            <label for="post_image_upload">File input</label>
            <input type="file" name="photo" id="post_image_upload">
            <p class="help-block">Upload Image for Post</p>
          </div>
      </div>
      <div class="clear"></div>
      <div class="form-group">
        <label for="input" class="col-sm-1 lab1">Title</label>
        <div class="col-sm-8">
         <input type="text" class="form-control" name="p_name" value="{{$ptw_title}}">
        </div>
      </div>
      <div class="clear"></div>
       <div class="form-group">
        <label for="input" class="col-sm-1 lab1 ">Description</label>
        <div class="col-sm-8">                
          <textarea class="form-control" name="p_desc" rows="4">{{$ptw_description}}</textarea>
        </div>
      </div>

      <div class="clear"></div>

      <div class="form-group">
        <label for="input" class="col-sm-1 lab1">Link</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="link" value="{{$ptw_Link}}">
        </div>
      </div>

      <div class="clear"></div>
      
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="clear"></div>
         <div class="col-sm-8">
         <hr/>
         </div>
         
          <div class="clear"></div>
        <div class="col-sm-1"></div> 
        <div class="col-sm-8 userpost_button">
       
        <a href="confirm"><input type="submit" class="btn btn-primary" value="Post"></a> 
        <p class="postbtn_desc">Post to users wall </p> 
        </div>
      </div>

       <div class="clear"></div>


    </form>       

{{$errorLog}}  
 </div>




@stop