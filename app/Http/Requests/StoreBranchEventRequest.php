<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreBranchEventRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(session('admin_loged') == 'branchManager')
			return true;
		else
			return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if(Request::input('event_id') != ''){
			return [
		        'title' => 'required|max:240',
		        'description' => 'required|min:10',
		        'publishdate' => 'required|date_format:m/d/Y',
		        'add_share_button' => 'required'
			];
		}else{
			return [
		        'title' => 'required|unique:events,title|max:240',
		        'description' => 'required|min:10',
		        'publishdate' => 'required|date_format:m/d/Y',
		        'add_share_button' => 'required',
		        'photo' => 'required|image'
			];
		}
	}

}
