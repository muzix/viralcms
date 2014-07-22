<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

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

    public function getQuizContestApp() {
        echo("<script> window.top.location.href='" . Config::get('facebook.pageTabUrl') . "'</script>");
    }

    public function prepareInfo() {
        //return View::make('apps.quizcontest.prepare');
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
                $pass = true;
            }
            if(!$pass) {
            //if(0){
                $params = array(
                  'scope' => 'public_profile, user_friends, email',
                  'redirect_uri' => Config::get('facebook.pageTabUrl')
                );
                $loginUrl = $facebook->getLoginUrl($params);
                echo("<script> window.top.location.href='" . $loginUrl . "'</script>");
                //echo("<script> window.open('" . $loginUrl . "');</script>");
            } else {
                return View::make('apps.quizcontest.prepare');
            }
        } else {
            //If the page is not liked then do this.
            return View::make('like');
        }
    }

	public function showQuizContest() {
		App::error(function(ModelNotFoundException $e)
		{
		    return Response::make('Not Found', 404);
		});
        // find user
        $userId = Input::get('userId');
        $user = User::find($userId);
        if ($user->id) {

            // get current active quiz
            $quiz = Quiz::where('status', 1)->orderBy('id')->get()->first();
            if (!$quiz) {
                return Response::make('Not Found', 404);
            }

            // get current active question
            $question = QuizQuestion::where('quiz_id', $quiz->id)->where('status', 1)->orderBy('priority')->get()->first();
            // If no question active then check for all available question for this quiz
            if (!$question) {
                $question = QuizQuestion::where('quiz_id', $quiz->id)->orderBy('priority')->get()->first();
                if (!$question) {
                    return Response::make('Not Found', 404);
                } else {
                    // make new question active
                    $question->status = 1;
                    $question->unlocked_at = Carbon::now();
                    $question->save();
                }
            } else {
                // check for unlocked_time
                
                $timeUnlocked = new Carbon($question->unlocked_at, 'Asia/Ho_Chi_Minh');
                //var_dump($timeUnlocked);return;
                $now = Carbon::now();
                //var_dump($now);return;
                $timeExist = $now->diffInMinutes($timeUnlocked); 
                //var_dump($timeExist);return;
                if ($timeExist >= 60*24) {
                    $question->status = 0;
                    $question->save();
                    $question = QuizQuestion::where('quiz_id', $quiz->id)->where('status', 0)->orderBy('priority')->get()->first();
                    if (!$question) {
                        return Response::make('Not Found', 404);
                    } else {
                        // make new question active
                        $question->status = 1;
                        $question->unlocked_at = Carbon::now();
                        $question->save();
                    }
                }
            }

            $answer = UserAnswer::where('user_id', $user->id)->where('question_id', $question->id)->get()->first();
            if ($answer) {
                //return View::make('apps.quizcontest.comeback');
            }

            // find first active quiz
            //$quiz = Quiz::where('status', '=',  1)->firstOrFail();

            // find question
            //$question = QuizQuestion::where('quiz_id', '=', $quiz->id)->where('status', '=', 1)->orderBy('priority')->firstOrFail();

            $questionAttribute = QuizQuestionAttribute::where('quiz_question_id', '=', $question->id)->firstOrFail();
            return View::make('apps.quizcontest.index')->with(array('quiz' => $quiz, 'question' => $question, 'youtube' => $questionAttribute->content, 'userId' => $user->id));
        }

        return Response::make('Please try again', 404);

    }

}