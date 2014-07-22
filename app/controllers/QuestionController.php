<?php

class QuestionController extends \BaseController {

	public function getList() {
		$quizId = Input::get('quizId', -1);
		if ($quizId == -1) {
			return Redirect::to('admin/quiz-contest/');
		}

		$quizWithQuestion = Quiz::with(array('questions.questionAttributes', 'questions.answers'))->where('id', $quizId)->get();
		// return $quizWithQuestion;

		return View::make('admin.quiz.question-list')->with(array('quizs' => $quizWithQuestion));
	}

    public function getCreate() {
        $quizId = Input::get('quizId', -1);
        if ($quizId == -1) {
            return Redirect::to('admin/quiz-contest/');
        }

        $quiz = Quiz::find($quizId);

        return View::make('admin.quiz.question-create')->with(array('quiz' => $quiz));
    }

    public function create() {

        $questionType = Input::get('question-type');
        $rule;

        if ($questionType == 'text') {
            $rules = array(
                'youtube' => array('required'),
                'question'    => array('required'),
                'answer' => array('required'),
            );
        } else if ($questionType == 'choice') {
            $rules = array(
                'youtube' => array('required'),
                'question'    => array('required'),
            );
        }


        $messages = array(
            'required' => 'Phần :attribute không được để trống.',
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            Input::flashOnly('youtube', 'question', 'answer');
            return Redirect::to('admin/quiz-contest/question/create?quizId='.Input::get('quizId'))->withErrors($validation);
        }

        // Validation succeed, create new question
        if ($questionType == 'text') {
            $question = new QuizQuestion;
            $question->question = Input::get('question');
            $question->answer = Input::get('answer');
            $question->status = 1;
            $question->quiz_id = Input::get('quizId');
            $question->question_type_id = 1;
            $question->save();

            if ($question->id) {
                $question->priority = $question->id;
                $question->save();

                // create question attribute
                $attribute = new QuizQuestionAttribute;
                $attribute->type_id = 1;
                $attribute->quiz_question_id = $question->id;
                $attribute->content = Input::get('youtube');
                $attribute->save();
            }

            $redirect = route('listQuestion', array('quizId' => Input::get('quizId')));
            return Redirect::to($redirect);
        } else if ($questionType == 'choice') {
            // Serialize question
            $choices = Input::get('choices');
            $choiceAnswer = Input::get('choice-answer');
            $comma_separated = implode(";", $choices);

            //var_dump(Input::get('question')); return;
            $questionString = Input::get('question') . ':' . $comma_separated;

            $question = new QuizQuestion;
            $question->question = $questionString;
            $question->answer = $choiceAnswer;
            $question->status = 1;
            $question->quiz_id = Input::get('quizId');
            $question->question_type_id = 2;
            $question->save();

            if ($question->id) {
                $question->priority = $question->id;
                $question->save();

                // create question attribute
                $attribute = new QuizQuestionAttribute;
                $attribute->type_id = 1;
                $attribute->quiz_question_id = $question->id;
                $attribute->content = Input::get('youtube');
                $attribute->save();
            }

            $redirect = route('listQuestion', array('quizId' => Input::get('quizId')));
            return Redirect::to($redirect);
        }

    }

    public function getEdit($questionId) {
        $question = QuizQuestion::find($questionId);
        return View::make('admin.quiz.question-edit')->with(array('question' => $question));
    }

    public function edit() {
        $questionId = Input::get('questionId');
        $question = QuizQuestion::find($questionId);

        $rules = array(
            'youtube' => array('required'),
            'question'    => array('required'),
            'answer' => array('required'),
        );

        $messages = array(
            'required' => 'Phần :attribute không được để trống.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            Input::flashOnly('youtube', 'question', 'answer');
            return Redirect::to('admin/quiz-contest/question/edit/'.$questionId)->withErrors($validation);
        }

        // Validation has succeeded. Update quiz
        $question->question = Input::get('question');
        $question->answer = Input::get('answer');
        $question->save();

        $questionAttribute = QuizQuestionAttribute::where('quiz_question_id', $questionId)->get();
        //return $questionAttribute[0];
        $questionAttribute[0]->update(array('content' => Input::get('youtube')));

        $redirect = route('listQuestion', array('quizId' => $question->quiz_id));
        return Redirect::to($redirect);
    }

    public function delete() {
        $questionId = Input::get('questionId');

        // Find all questionAttribute and destroy
        $questionAttributes = QuizQuestionAttribute::where('quiz_question_id', $questionId)->delete();

        $question = QuizQuestion::find($questionId);
        $quizId = $question->quiz_id;
        $question->delete();
        $redirect = route('listQuestion', array('quizId' => $quizId));
        return Redirect::to($redirect);
    }
}