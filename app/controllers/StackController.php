<?php

class StackController extends \BaseController {

	public function invite()
	{
        $config = array();
        $config['appId'] = Config::get('facebook.appId');
        $config['secret'] = Config::get('facebook.secret');
        $config['fileUpload'] = true; // optional
        $facebook = new Facebook($config);
        $signed_request = $facebook->getSignedRequest();
        $like_status = $signed_request["page"]["liked"];
        if ($like_status) { //If the page is liked then display full app.
            //If already authorized
            $pass = false;
            if(isset($signed_request["oauth_token"])) {
                //check extented permission
                $permissions = $facebook->api("/me/permissions");
                if(array_key_exists('publish_actions', $permissions['data'][0])) {
                 // granted
                    $pass = true;
                } else {
                 // skipped
                    $pass = false;
                }
            }
            if(!$pass) {
            //if(0){
                $params = array(
                  'scope' => 'user_about_me, user_birthday, user_friends, user_hometown, user_location, email, publish_actions',
                  'redirect_uri' => Config::get('facebook.appUrl')
                );
                $loginUrl = $facebook->getLoginUrl($params);
                echo("<script> window.top.location.href='" . $loginUrl . "'</script>");
                //echo("<script> window.open('" . $loginUrl . "');</script>");
            } else {
                return View::make('invite');
            }
        } else {
            //If the page is not liked then do this.
            return View::make('like');
        }
	}

	/**
	 * Display a listing of the resource.
	 * GET /stack
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /stack/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /stack
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /stack/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /stack/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /stack/{id}
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
	 * DELETE /stack/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}