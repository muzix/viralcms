<?php
namespace api\v1p1;
use Carbon\Carbon;
use GameEvent;
use Item;
use Admin;
use ItemsDistribution;
use Location;
use SpawnedItem;
use User;
use UserTracking;
use Input;
class UsersController extends BaseController {

	public function getLogin()
	{
		$fbid = Input::get('uid', '');
		$username = Input::get('username', '');
		$name = Input::get('name', '');
		$first_name = Input::get('first_name', '');
		$middle_name = Input::get('middle_name', '');
		$last_name = Input::get('last_name', '');
		$birthday = Input::get('birthday', '');
		$place = Input::get('hometown', '');
		$gender = Input::get('gender', '');
		$email = Input::get('email', '');
		$link = Input::get('link', '');

		$userModel = User::where('fbid', $fbid)->get();
		$user = $userModel->toArray();
		if (count($user) <= 0) {
			// create new user
			if ($fbid == '') return '';
			$userToSave = User::create(array(
				'fbid' => $fbid,
				'username' => $username,
				'shortname' => $name,
				'fullname' => $first_name.' '.$middle_name.' '.$last_name,
				'birthday' => new Carbon($birthday),
				'gender' => $gender,
				'place' => $place,
				'email' => $email,
				'last_login_at' => Carbon::now(),
				'created_at' => Carbon::now()
			));
			return $userToSave;
		} else {
			// update last login
			$userToRet = $userModel->first();
			$userToRet->last_login_at = Carbon::now()->toDateTimeString();
			$userToRet->save();
			return $userToRet;
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
