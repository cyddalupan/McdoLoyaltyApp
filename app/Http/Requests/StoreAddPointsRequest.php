<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreAddPointsRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
		/*
		if(session('admin_loged') == 'admin')
			return true;
		else
			return false;
			*/
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
	        'points' => 'required|integer',
	        'user_id' => 'required'
		];
	}

}
