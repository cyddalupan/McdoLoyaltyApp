@extends('DashPlate')

@section('title')
   Loyalty APP
@stop

@section('page htag')
<span class="glyphicon glyphicon-share" aria-hidden="true"></span>&nbsp;&nbsp;Confirm Post
@stop

@section('content')   
<div class="jumbotron jumb">
	<div class="row nametitle">
  <h3><b>LOYALTY APP</b></h3><br/>

  <h4><b><span class="glyphicon glyphicon-ok okgly" aria-hidden="true"></span>&nbsp;&nbsp;Post has been sent</b></h4>
</div>
	<div class="row nametitle2">
		  Content of this message has been approved.<br>	
		  Are you sure you want to submit this notification?
	</div>
	<br>


	<div class="row butcon">
        <div class="col-sm-1"></div>
        <div class="col-sm-8 a_left">
        	<div class="row butcon"></div>
        <a href="share"><input type="submit" class="btn btn-primary" value="Edit Again"/></a> 
        <a href="blast"><input type="submit" class="btn btn-success" value="Post To All User" href="share"/></a> 
        </div>
    </div>
  </div>
  
@include('send2Blast')

@stop
