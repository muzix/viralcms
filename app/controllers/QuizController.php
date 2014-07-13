<?php

class QuizController extends \BaseController {

	public function create() {
        $rules = array(
            'title' => array('required'),
            'description'    => array('required'),
            'banner' => 'image|mimes:jpeg,png|max:3000',
        );

        $messages = array(
            'required' => 'Phần :attribute không được để trống.',
            'banner.image' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.mime' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.max' => 'Kích thước file ảnh không được vượt quá 3MB.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            return Redirect::to('admin/quiz-contest/quiz/create')->withInput(Input::all())->withErrors($validation);
        }

        // Validation has succeeded. Create new user.

        // receive banner image
        $file = Input::file('banner'); // your file upload input field in the form should be named 'file'
        $uploadSuccess = false;
        if ($file) {
            $destinationPath = app_path().'/assets/uploads/admin/quiz-contest/';
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            $filename = uniqid().'.'.$extension;
            $uploadSuccess = Input::file('banner')->move($destinationPath, $filename);
        } else {
            $filename = '';
            $uploadSuccess = true;
        }

        if( $uploadSuccess ) {
            $newQuiz = new Quiz;
            $newQuiz->title = Input::get('title');
            $newQuiz->description = Input::get('description');
            $newQuiz->privacy = Input::get('privacy');
            $newQuiz->term = Input::get('term');
            $newQuiz->banner = $filename;
            $newQuiz->save();
            return Redirect::to('admin/quiz-contest/');
        }

        return Redirect::to('admin/quiz-contest/quiz/create')->withInput(Input::all())->withErrors($validation);

    }

    public function delete() {
        $quizId = Input::get('quizId');
        $quiz = Quiz::find($quizId);
        $quiz->delete();
        return Redirect::to('admin/quiz-contest/');
    }

    public function getEdit($quizId) {
        $quiz = Quiz::find($quizId);
        return View::make('admin.quiz.quiz-edit')->with(array('quiz' => $quiz));
    }

    public function edit() {

        $quizId = Input::get('quizId');
        $quiz = Quiz::find($quizId);

        $rules = array(
            'title' => array('required'),
            'description'    => array('required'),
            'banner' => 'image|mimes:jpeg,png|max:3000',
        );

        $messages = array(
            'required' => 'Phần :attribute không được để trống.',
            'banner.image' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.mime' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.max' => 'Kích thước file ảnh không được vượt quá 3MB.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            return Redirect::to('admin/quiz-contest/quiz/edit/'.$quizId)->with(array('quiz' => $quiz))->withErrors($validation);
        }

        // Validation has succeeded. Create new user.

        // receive banner image
        $file = Input::file('banner'); // your file upload input field in the form should be named 'file'
        $uploadSuccess = false;
        if ($file) {
            $destinationPath = app_path().'/assets/uploads/admin/quiz-contest/';
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            $filename = uniqid().'.'.$extension;
            $uploadSuccess = Input::file('banner')->move($destinationPath, $filename);
            if (!$uploadSuccess) {
                $filename = $quiz->banner;
            }
        } else {
            $filename = $quiz->banner;
        }
        
        $quiz->title = Input::get('title');
        $quiz->description = Input::get('description');
        $quiz->privacy = Input::get('privacy');
        $quiz->term = Input::get('term');
        $quiz->banner = $filename;
        $quiz->save();
        return Redirect::to('admin/quiz-contest/');
        

    }

    public function getList() {
        $quizs = Quiz::with('questions')->get();
        return View::make('admin.quiz.quiz-list')->with(array("quizs"=>$quizs));
    }

    public function getCreate() {
        return View::make('admin.quiz.quiz-create');
    }

}