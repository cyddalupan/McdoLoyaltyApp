<div class="clear" style="color:#000;">

<div class="col-md-5 addbranch_table">
				<table class="table">
					<tr> 
						<th  class="row branch_field">Post to Branch</th>
					</tr>
					<tr>
						<td class="row tablerecord">
							<fieldset>
							    <div><input type="checkbox" class="checkall"><b>Check all</b></div>
								@foreach ($branches as $branch)
								    <div><input name="locations[]" value="{{$branch->id}}" type="checkbox" {{$branch->checked}}>{{$branch->branch_name}}</div>
								@endforeach
							</fieldset>
						</td>
						
					</tr>
					
				</table>
			</div>

			<div class="clear"></div>

<script type="text/javascript">
$(function () {
    $('.checkall').on('click', function () {
        $(this).closest('fieldset').find(':checkbox').prop('checked', this.checked);
    });
});
</script>
</div>