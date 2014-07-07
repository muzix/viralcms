<?php

class AppController extends \Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function getInfo() {
		$info = array("version" => "1.1", "api" => "https://tibu.tk/galaxystudio/public/api/", "apiVersion" => "v1p1",
					  "message" => "Hãy cập nhật phiên bản mới!", "redirectLink" => "https://itunes.apple.com/vn/app/bat-sieu-nhen-chop-sieu-qua/id854291550?mt=8");
		return json_encode($info, JSON_UNESCAPED_UNICODE);
	}

	public function quiz() {
        return View::make('apps.quizcontest.index');
    }

}