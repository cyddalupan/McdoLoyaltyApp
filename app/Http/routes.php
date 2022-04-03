<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//front end
//index page of the app, shows on facebook tab
Route::any('/',  'HomeController@index');
//if user not yet join
Route::any('/home', 'HomeController@home');
//add session for login
Route::any('/loginsession', ['middleware' => 'cydAjaxFilter', 'uses' =>'HomeController@loginsession']);
//index page of the app, shows on facebook tab
Route::any('/user', ['middleware' => 'check_login', 'uses' =>'HomeController@user']);
//select branch
Route::post('/user/select-branch', 'HomeController@select_branch');
//send test post
Route::any('/user/test-post', ['middleware' => 'check_login', 'uses' => 'HomeController@test_post']);
//index page of the app, shows on facebook tab
Route::post('/update_user_post_to_my_wall', ['middleware' => 'cydAjaxFilter', 'uses' =>'HomeController@update_user_post_to_my_wall']);
//get last scan data of a user
Route::post('/all_fb_id', ['middleware' => 'cydAjaxFilter', 'uses' =>'HomeController@all_fb_id']);
//get last scan data of a user
Route::post('/last_scan/{user_fb_id}', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@getLastScan']);
//get last scan data of a user
Route::post('/save_post', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@savePost']);
//get last scan data of a user
Route::post('/all_post_id', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@all_post_id']);
//Update Likes
Route::post('/updateLikes', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@updateLikes']);
//adding new User to Database
Route::post('/insert_user', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@insert_user']);
//converting facebook access token to long term token (60 days)
Route::post('/extend_token/{cyd_token}', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@extend_token']);
//saving the new token to database
Route::post('/renew_token/{user_fb_id}/{long_token_data}', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@renew_token']);
//update user Points
Route::post('/update_points', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@update_points']);
//adding new User to Database
Route::post('/insert_suggestion', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@insert_suggestion']);
//get event to lightbox
Route::post('/get_event', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@get_event']);
//delete user post if deleted on facebook
Route::post('/delete_user_post', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@delete_user_post']);
//change post privacy in case user change it
Route::post('/user_post_change_privacy', ['middleware' => 'cydAjaxFilter', 'uses' => 'HomeController@user_post_change_privacy']);

//manager admin
Route::any('/manager-admin/{manager_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@index']);
Route::any('/manager-admin/add-event/{manager_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@add_events']);
Route::post('/submit-event', ['middleware' => 'test_manager', 'uses' => 'ManagerController@submit_events']);
Route::any('manager-admin/not-on-my-branch/{joiner_id}/{manager_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@not_on_my_branch']);
Route::any('manager-admin/yes-accept-user/{joiner_id}/{manager_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@yes_accept_user']);
Route::get('manager-admin/delete/{event_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@delete']);
Route::post('manager-admin/edit/{event_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@edit_events']);
Route::get('manager-admin/send_notification/{manager_id}/{event_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@send_notification']);
Route::any('send_notification_contact_fb', ['middleware' => 'test_manager', 'uses' => 'ManagerController@send_notification_contact_fb']);
Route::any('manager-admin/change_image/{event_id}/{manager_id}', ['middleware' => 'test_manager', 'uses' => 'ManagerController@change_image']);

//prizes page
Route::any('/prizes/', 'PrizePageController@index');

//events front
Route::any('/page_event/{event_id}', 'EventPageController@index');
Route::post('/our_event/', 'EventPageController@ourEvent');

//backEnd
Route::get('/dashboard', ['middleware' => 'test_admin', 'uses' => 'DashboardController@index']);
Route::get('/dashboard/delete/{facebook_id}', ['middleware' => 'test_admin', 'uses' => 'DashboardController@destroy']);
Route::get('/dashboard/restore/{facebook_id}', ['middleware' => 'test_admin', 'uses' => 'DashboardController@restore']);
Route::get('/dashboard/change-user-type/{facebook_id}/{user_type}', ['middleware' => 'test_admin', 'uses' => 'DashboardController@change_user_type']);

Route::get('/editor', ['middleware' => 'test_admin', 'uses' => 'EditorController@index']);
Route::post('/editor/save', ['middleware' => 'test_admin', 'uses' => 'EditorController@save']);
Route::get('editor/badwords', ['middleware' => 'test_admin', 'uses' => 'EditorController@badwords']);
Route::post('editor/save_badword', ['middleware' => 'test_admin', 'uses' => 'EditorController@save_badword']);
Route::get('/editor/delete_badword/{badword_id}', ['middleware' => 'test_admin', 'uses' => 'EditorController@delete_badword']);
Route::get('/editor/quick_settings', ['middleware' => 'test_admin', 'uses' => 'EditorController@quick_settings']);
Route::post('/editor/quick_submit', ['middleware' => 'test_admin', 'uses' => 'EditorController@quick_submit']);

Route::any('/share', ['middleware' => 'test_admin', 'uses' => 'ShareController@index']);
Route::any('/blast', ['middleware' => 'test_admin', 'uses' => 'ShareController@blast']);

Route::any('/branch', ['middleware' => 'test_admin', 'uses' => 'BranchController@index']);
Route::get('/branch/branchMembers/{branch_id}', ['middleware' => 'test_admin', 'uses' => 'BranchController@branchMembers']);
Route::post('/branch/add', ['middleware' => 'test_admin', 'uses' => 'BranchController@add']);
Route::any('/branch/delete/{branch_id}', ['middleware' => 'test_admin', 'uses' => 'BranchController@delete']);
Route::any('/branch/restore/{branch_id}', ['middleware' => 'test_admin', 'uses' => 'BranchController@restore']);
Route::any('/branch/user_post/{facebook_id}', ['middleware' => 'test_admin', 'uses' => 'BranchController@user_post']);

Route::any('/events', ['middleware' => 'test_admin', 'uses' => 'EventsController@index']);
Route::get('/events/selectBranch', ['middleware' => 'test_admin', 'uses' => 'EventsController@selectBranch']);
Route::any('/new-event', ['middleware' => 'test_admin', 'uses' => 'EventsController@new_event']);
Route::any('/new-event/insert', ['middleware' => 'test_admin', 'uses' => 'EventsController@insert']);
Route::any('/events/edit/{event_id}', ['middleware' => 'test_admin', 'uses' => 'EventsController@edit']);
Route::any('/events/delete/{event_id}', ['middleware' => 'test_admin', 'uses' => 'EventsController@delete']);
Route::any('/events/restore/{event_id}', ['middleware' => 'test_admin', 'uses' => 'EventsController@restore']);
Route::get('/events/change_image/{event_id}', ['uses' => 'EventsController@change_image']);
Route::post('/events/change_image_submit', ['uses' => 'EventsController@change_image_submit']);

Route::get('/add-points', ['middleware' => 'test_admin', 'uses' => 'AddpointsController@index']);
Route::post('/add-points/store', ['middleware' => 'test_admin', 'uses' => 'AddpointsController@store']);

Route::get('/suggestion', ['middleware' => 'test_admin', 'uses' => 'SuggestionController@index']);
Route::get('/suggestion/delete/{suggestion_id}', ['middleware' => 'test_admin', 'uses' => 'SuggestionController@delete']);
Route::get('/suggestion/delete_day/{day}', ['middleware' => 'test_admin', 'uses' => 'SuggestionController@delete_day']);
Route::get('/suggestion/trash', ['middleware' => 'test_admin', 'uses' => 'SuggestionController@trash']);
