<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\suggestions;

use Illuminate\Http\Request;

class SuggestionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$suggestions = suggestions::all();

		$suggestionDays = array();
		$oldDate = '';
		foreach ($suggestions as $suggestion) {
			$groupDay = date('Ymd', strtotime($suggestion->created_at));
			$convertedDate = date('l,d F Y', strtotime($suggestion->created_at));
			

			$suggestion->delete_link = url().'/suggestion/delete/'.$suggestion->id;

			$suggestionDays[$groupDay]['day'] = $convertedDate;
			$suggestionDays[$groupDay]['delete_whole_day_link'] =  url().'/suggestion/delete_day/'.$groupDay;
			$suggestionDays[$groupDay]['values'][] = $suggestion;

		}

		return view('suggestion')->withSuggestions($suggestionDays);
	}

	public function delete_day($day){
		
		$suggestions = suggestions::all();

		foreach ($suggestions as $suggestion) {
			$groupDay = date('Ymd', strtotime($suggestion->created_at));
			if($day == $groupDay){
				$suggestion->delete();
			}
		}

		return redirect()->back();
	}

	public function trash(){
		$deleted_suggestions = suggestions::onlyTrashed()->get();
		return view('suggestionTrash')->withDeleted_suggestions($deleted_suggestions);
	}

	public function delete($id)
	{
		$suggestion = suggestions::find($id);
		$suggestion->delete();

		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
