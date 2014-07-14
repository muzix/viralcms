<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

// Route::get('/authtest', array('before' => 'auth.basic', function()
// {
// 	return View::make('hello');
// }));

// Route::get('users', function()
// {
//     $users = User::all();

//     return View::make('users')->with('users', $users);
// });

// Route::get('/statistics', array('before' => 'auth.basic', function()
// {
// 	$trackings = UserTracking::with(array(
// 					'voucher',
// 					'spawnedItem.item',
// 					'spawnedItem.user'))->whereHas('spawnedItem', function($q){
// 		$q->whereIn('item_id', array(3,4,5))->whereNotIn('user_id', array(13,14,15));
// 	})->get();
// 	// foreach($trackings as $tracking) {
// 	// 	if ($tracking->voucher == null) {
// 	// 		//update voucher for this user
// 	// 		$voucher = Voucher::whereNull('user_tracking_id')->take(1)->get()->first();
// 	// 		$tracking->voucher_id = $voucher->id;
// 	// 		$tracking->save();
// 	// 		$voucher->user_tracking_id = $tracking->id;
// 	// 		$voucher->save();
// 	// 	}
// 	// }

// 	return View::make('statistics')->with('trackings', $trackings);
// }));

// Route::get('/myvouchers', function () {
// 	$fbid = Input::get('fbid', '');
// 	if ($fbid == '') return "Bạn chưa đăng nhập";
// 	$vouchers = Voucher::with(array('userTracking.spawnedItem.user', 'userTracking.spawnedItem.item'))->whereHas('userTracking', function($q) use ($fbid) {
// 		$q->whereHas('spawnedItem', function($q) use ($fbid) {
// 			$q->whereHas('user', function($q) use ($fbid) {
// 				$q->where('fbid', $fbid);
// 			});
// 		});
// 	})->get();

// 	$special = UserTracking::with(array(
// 					'voucher',
// 					'spawnedItem.item',
// 					'spawnedItem.user'))->whereHas('spawnedItem', function($q) use ($fbid) {
// 		$q->whereIn('item_id', array(3))->whereNotIn('user_id', array(14,15))->whereHas('user', function($q) use($fbid) {
// 			$q->where('fbid', $fbid);
// 		});
// 	})->get();

// 	if (count($vouchers->toArray()) <= 0) return "Bạn chưa có phiếu thưởng nào.";
// 	return View::make('my_vouchers')->with('vouchers', $vouchers)->with('special', $special);
// });

// // Route group for API versioning
// Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
// //Route::group(array('prefix' => 'api/v1'), function()
// {
// 	Route::resource('events', 'api\v1p1\EventsController');
// 	Route::resource('locations', 'api\v1p1\LocationsController');
// 	Route::controller('items', 'api\v1p1\ItemsController');
// 	Route::controller('users', 'api\v1p1\UsersController');
// });

// Route::group(array('prefix' => 'api/v1p1', 'before' => 'auth.basic'), function()
// //Route::group(array('prefix' => 'api/v1'), function()
// {
// 	Route::resource('events', 'api\v1p1\EventsController');
// 	Route::resource('locations', 'api\v1p1\LocationsController');
// 	Route::controller('items', 'api\v1p1\ItemsController');
// 	Route::controller('users', 'api\v1p1\UsersController');
// });

// Route::group(array('prefix' => 'api'), function()
// //Route::group(array('prefix' => 'api/v1'), function()
// {
// 	Route::controller('app', 'AppController');
// });

// Route for event pagetab
Route::get('event/inviteapp/', 				'StackController@inviteapp');
Route::post('event/inviteapp/', 			'StackController@inviteapp');
Route::get('event/invite/', 				'StackController@invite');
Route::post('event/invite/', 				'StackController@invite');
Route::post('user/autocreate/', 			'UserController@autocreate');
Route::get('user/autocreate/', 				'UserController@autocreate');
Route::group(array('before' => 'csrf'), function() {
    Route::post('invitation/create/', 	'StackController@create');
    //Route::get('invitation/create/', 'StackController@create');
});
Route::get('invitation/lists', 				'StackController@lists');
Route::get('image/create',					'ImageController@create');
Route::post('image/create', 				'ImageController@create');
Route::get('invitation/rank/', 				'StackController@rank');

// Route for admin backend
Route::get('admin', 							'AdminController@showDashboard');
Route::get('admin/ru-ao-trung-that', 			'AdminController@showDashboard');
Route::get('admin/quiz-contest', 				'QuizController@getList');
Route::get('admin/quiz-contest/quiz/list', 		'QuizController@getList');
Route::get('admin/quiz-contest/quiz/create', 	'QuizController@getCreate');
Route::get('admin/quiz-contest/quiz/edit/{id}', 'QuizController@getEdit');
Route::get('admin/quiz-contest/question',		array('as' => 'listQuestion', 'uses' => 'QuestionController@getList'));
Route::get('admin/quiz-contest/question/create', array('as' => 'getQuestionCreate', 'uses' => 'QuestionController@getCreate'));
Route::get('admin/quiz-contest/question/edit/{id}', array('as' => 'getQuestionEdit', 'uses' => 'QuestionController@getEdit'));
// Route for apps
Route::get('quiz', 'AppController@quiz');

Route::group(array('before' => 'csrf'), function() {
    Route::post('admin/quiz-contest/quiz/create', array('as' => 'createQuiz', 'uses' => 'QuizController@create'));
    Route::post('admin/quiz-contest/quiz/delete', array('as' => 'deleteQuiz', 'uses' => 'QuizController@delete'));
    Route::post('admin/quiz-contest/quiz/edit', array('as' => 'editQuiz', 'uses' => 'QuizController@edit'));
    Route::post('admin/quiz-contest/question/create', array('as' => 'createQuestion', 'uses' => 'QuestionController@create'));
    Route::post('admin/quiz-contest/question/edit', array('as' => 'editQuestion', 'uses' => 'QuestionController@edit'));
    Route::post('admin/quiz-contest/question/delete', array('as' => 'deleteQuestion', 'uses' => 'QuestionController@delete'));
    //Route::get('invitation/create/', 'StackController@create');
});


// Confide routes
Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');
