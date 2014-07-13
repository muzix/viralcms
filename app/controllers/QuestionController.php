<?php

class QuestionController extends \BaseController {

	public function getList() {
		$quizId = Input::get('quizId', -1);
		if ($quizId == -1) {
			return Redirect::to('admin/quiz-contest/');
		}

		$quizWithQuestion = Quiz::with('questions.questionAttributes')->where('id', $quizId)->get();
		//return $quizWithQuestion;
		
		return View::make('admin.quiz.question-list')->with(array('quizs' => $quizWithQuestion));
	}
}