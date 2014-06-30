<?php

class StackController extends \BaseController {

    public function inviteapp() {
         echo("<script> window.top.location.href='" . Config::get('facebook.pageTabUrl') . "'</script>");
    }

	public function invite()
	{
        $rawSignedRequest = Input::get('signed_request');

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
                  'redirect_uri' => Config::get('facebook.pageTabUrl')
                );
                $loginUrl = $facebook->getLoginUrl($params);
                echo("<script> window.top.location.href='" . $loginUrl . "'</script>");
                //echo("<script> window.open('" . $loginUrl . "');</script>");
            } else {
                return View::make('invite')->with('signedRequest', $rawSignedRequest);
            }
        } else {
            //If the page is not liked then do this.
            return View::make('like');
        }
	}

	public function create()
	{
		if (Auth::guest()) {
			$res = array("status" => "error", "message" => "notlogged" );
            return Response::json($res);
		}
		$fromId = Input::get('fromId', '');
		$toId = Input::get('toId', '');
		$toName = Input::get('toName', '');
		$code = uniqid();

		// check if toId exist in facebook
		$search = json_decode($this->curl_get_contents("https://graph.facebook.com/$toId"));

		if(!isset($search->id))
		{
			$res = array("status" => "error", "message" => "notexist" );
            return Response::json($res);
		}

		$invitations = Invitation::where('from_id', $fromId)->get();
		$invitationArr = $invitations->toArray();
		$exist = false;
		if (count($invitationArr) > 0) {
			foreach($invitationArr as $invite) {
				if ($invite['to_id'] == $toId) {
					$exist = true;
					break;
				}
			}
		}

		if ($exist) {
			$res = array("status" => "error", "message" => "exist" );
            return Response::json($res);
		}

		$invitation = new Invitation;

		$invitation->from_id = $fromId;
		$invitation->to_id = $toId;
		$invitation->to_name = $toName;
		$invitation->code = $code;

		$invitation->save();

		if ($invitation->id) {
            $res = array("status" => "success", "code" => $code, "id" => $invitation->id);
            Session::put('_token', sha1(microtime()));
			return Response::json($res);
		} else {
            $res = array("status" => "error", "message" => "exist" );
            return Response::json($res);
		}
	}

	function curl_get_contents($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public function lists()
	{
		$id = Input::get('id', '');
		$invitations = Invitation::where('from_id', $id)->get();
		return $invitations;
	}

    public function rank()
    {
       $groups = DB::table('invitations')
                ->join('users', 'invitations.from_id', '=', 'users.fbid')
                ->select(array('from_id', DB::raw('COUNT(*) `amount`'), 'username', 'shortname', 'fullname'))
                ->groupBy('from_id')
                ->orderBy('amount', 'DESC')
                ->take(5)
                ->get();

        return $groups;
        // foreach ($groups as $g) {
        //     echo "$g->shortname has $g->amount invites!";
        // }
    }

    public function token() {
        return View::make('token');
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