@extends('DashPlate')

@section('title')
   Bad Words
@stop

@section('submenu')
	 <ul class="nav nav-pills">
        <li role="presentation"><a href="{{url()}}/editor" class="badwords_got_link">Settings</a></li>
        <li role="presentation" class="active"><a href="#">Restrictions</a></li>
    </ul>
@stop

@section('page htag')
<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;&nbsp;App Settings
@stop

@section('content')

<div class="col-md-10 subtitle_desc"><p>Restrict bad words/foul language</p></div>
<div class="clear"></div>
<div class="col-md-10"><hr/></div>
<div class="clear"></div>


	<div style="color:red;">
		@foreach ($errors->all() as $error)
		    <p>Error {{$error or ''}}</p>
		@endforeach
	</div>
	<div class="row" style="color:black;">
	
	<div class="col-md-10 input_words">
		<form action="{{url()}}/editor/save_badword" method="post">
			keyword: <input type="text" name="badword" />
			<input type="submit" value="submit">
		</form>
	</div>
	<div class="clear"></div>
	<div class="col-md-5 filterwords_table">
			 <table class="table">
	            <tr> 
	              <th colspan="2" class="row filter_subtitle">Filtered Words</th>
	              
	            </tr>
	          	@foreach ($badwords as $badword)
            	<tr>
					
					<td class="row filter_words"><p>{{$badword->bad_word}}</p></td>                       
					<td class="row filter_words"><a href="{{$badword->delete_link}}"class="delete_word">
					<span class="glyphicon glyphicon-minus-sign remove" aria-hidden="true">	</span>&nbsp;&nbsp;delete</a></td>
            	</tr>
				@endforeach
             </table>
		</div>

	
	

	</div>
@stop