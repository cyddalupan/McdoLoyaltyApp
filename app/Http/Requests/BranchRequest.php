<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BranchRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(session('admin_loged') == 'admin')
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
		return [
	        'Branch_Location' => 'required|unique:branch_list,branch_name',
			'Branch_City' =>'required',
	        'Branch_Manager' => 'required'
		];
	}
}
