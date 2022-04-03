@extends('template')

@section('page_title')
   index
@stop

@section('content')

<!--facebook JS-->
<script type="text/javascript">
	//declare app_id
	var cyd_app_id = <?php echo $app_id; ?>;
	var public_url = "{{url()}}/";
</script>

@stop



				