@extends('DashPlate')

@section('title')
   App settings
@stop

@section('page htag')
<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;&nbsp;App settings
@stop

@section('submenu')
    <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="#">Settings</a></li>
        <li role="presentation"><a href="{{url()}}/editor/badwords" class="badwords_got_link">Restrictions</a></li>
    </ul>
@stop

@section('content')
<div id="App_settings">

<div class="col-md-10 subtitle_desc"><p>Edit default details for posting</p></div>
<div class="clear"></div>
<div class="col-md-10"><hr/></div>
<div class="clear"></div>
<div class="row appsettings_form">
		<form action="editor/save" method="post">
			<div class="form-group">
		        <label for="input" class="col-sm-2 title_editor">Title</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_name"  placeholder="Title"  value="{{$settingArr['ptw_title']}}">
		        </div>
		    </div>
		    <div class="clear"></div>
		    <br>
			<div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Description</label>
		        <div class="col-sm-6">
		          <textarea class="form-control" name="user_desc" rows="4" placeholder="Textarea">{{$settingArr['ptw_description']}}</textarea>
		        </div>
		    </div>
		
		    <div class="clear"></div>
		    <br>
			<div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Link</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_link"  placeholder="Jollibee" value="{{$settingArr['ptw_Link']}}">
		        </div>
		    </div>
		    
		    <div class="clear"></div>
			    <br>
		      <div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Switch Points</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="switch_points"  placeholder="KFC" value="{{$settingArr['posttowall_points']}}">
		        </div>
		    </div>
		     <div class="clear"></div>
		     <br>
			<div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Post Point</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_point"  placeholder="KFC" value="{{$settingArr['post_point']}}">
		        </div>
		    </div>
		     <div class="clear"></div>
		     <br>
			 <div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Post Like</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_like" placeholder="Like" value="{{$settingArr['like_point']}}">
		        </div>
		    </div>
		     <div class="clear"></div>
		     <br>
		    <div class="form-group">
		        <br>
		        <label for="input" class="col-sm-2 title_editor ">Auto post points</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="auto_post_points" placeholder="KeyWord5" value="{{$settingArr['auto_post_points']}}">
		        </div>
		    </div>
		     <div class="clear"></div>
		    <div class="form-group">
		        <label for="input" class="col-sm-2 title_editor ">Comment Points</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="comment_point" placeholder="Comment" value="{{$settingArr['comment_point']}}">
		        </div>
		    </div>
		    
		       <div class="clear"></div>
			<div class="form-group">
				<br>
		        <label for="input" class="col-sm-2 title_editor ">KeyWord 1</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_setwords" placeholder="KeyWord1" value="{{$settingArr['find_word']}}">
		        </div>
		    </div>
		    <div class="form-group">
		        <br>
		        <label for="input" class="col-sm-2 title_editor ">KeyWord 2</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_setwords2" placeholder="KeyWord2" value="{{$settingArr['find_word_2']}}">
		        </div>
		    </div>
		    <div class="form-group">
		        <br>
		        <label for="input" class="col-sm-2 title_editor ">KeyWord 3</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_setwords3" placeholder="KeyWord3" value="{{$settingArr['find_word_3']}}">
		        </div>
		    </div>
		    <div class="form-group">
		        <br>
		        <label for="input" class="col-sm-2 title_editor ">KeyWord 4</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_setwords4" placeholder="KeyWord4" value="{{$settingArr['find_word_4']}}">
		        </div>
		    </div>
		    <div class="form-group">
		        <br>
		        <label for="input" class="col-sm-2 title_editor ">KeyWord 5</label>
		        <div class="col-sm-6">
		         <input type="text" class="form-control" name="user_setwords5" placeholder="KeyWord5" value="{{$settingArr['find_word_5']}}">
		        </div>
		    </div>
		   
			<div class="col-md-6 row Inputwords">
				<div class="col-md-6 subfind">
				
			 <div class="row">
		        <div class="col-sm-1"></div>
		   	  <div class="clear"></div>     
		        <div class="col-sm-8 userupdt_button">
		       		 <input class="btn btn-default btn-info" type="submit" value="Save changes">
			</div>
		      </div>
		  <div class="clear"></div>
		      	<div class="row">
		      		<div class="col-md-8 userupdt_note">         
		        	<p>By clicking this button, default action will be executed. </p> 
		    	</div>
			</div>
				</form>
		<br><br><br>
	</div>	
</div>	

<div>
	<br><br><br>
</div>

</div>
</div>
@stop