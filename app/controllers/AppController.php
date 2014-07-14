<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

	public function showQuizContest() {
		App::error(function(ModelNotFoundException $e)
		{
		    return Response::make('Not Found', 404);
		});

		// find first active quiz
		$quiz = Quiz::where('status', '=',  1)->firstOrFail();

		// find question
		$question = QuizQuestion::where('quiz_id', '=', $quiz->id)->where('status', '=', 1)->orderBy('priority')->firstOrFail();

		$questionAttribute = QuizQuestionAttribute::where('quiz_question_id', '=', $question->id)->firstOrFail();

        return View::make('apps.quizcontest.index')->with(array('quiz' => $quiz, 'question' => $question, 'youtube' => $questionAttribute->content));
    }

}