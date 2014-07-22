<?php

class QuizController extends \BaseController {

	public function create() {
        $rules = array(
            'title' => array('required'),
            'description'    => array('required'),
            'banner' => 'image|mimes:jpeg,png,jpg|max:3000',
            'background' => 'image|mimes:jpeg,png,jpg|max:3000',
        );

        $messages = array(
            'required' => 'Phần :attribute không được để trống.',
            'banner.image' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.mimes' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'banner.max' => 'Kích thước file ảnh không được vượt quá 3MB.',
            'background.image' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'background.mimes' => 'Hãy chọn file ảnh định dạng jpg hoặc png.',
            'background.max' => 'Kích thước file ảnh không được vượt quá 3MB.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            Input::flashOnly('title', 'description', 'privacy', 'term');
            return Redirect::to('admin/quiz-contest/quiz/create')->withErrors($validation);
        }

        // Validation has succeeded. Create new quiz.

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

        // receive background image
        $file = Input::file('background'); // your file upload input field in the form should be named 'file'
        $uploadBackground = false;
        if ($file) {
            $destinationPath = app_path().'/assets/uploads/admin/quiz-contest/';
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            $filenameBG = uniqid().'.'.$extension;
            $uploadBackground = Input::file('background')->move($destinationPath, $filenameBG);
        } else {
            $filenameBG = '';
            $uploadBackground = true;
        }

        if( $uploadSuccess && $uploadBackground ) {
            $newQuiz = new Quiz;
            $newQuiz->title = Input::get('title');
            $newQuiz->description = Input::get('description');
            $newQuiz->privacy = Input::get('privacy');
            $newQuiz->term = Input::get('term');
            $newQuiz->banner = $filename;
            $newQuiz->background = $filenameBG;
            $newQuiz->save();

            $schedule = new QuizSchedule;
            $schedule->name = $newQuiz->title;
            $schedule->start_time = Input::get('schedule');
            $schedule->interval = 24;
            $schedule->status = 1;
            $schedule->quiz_id = $newQuiz->id;
            $schedule->save();

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
        $schedule = QuizSchedule::where('quiz_id', $quizId)->get()->first();
        return View::make('admin.quiz.quiz-edit')->with(array('quiz' => $quiz, 'schedule' => $schedule));
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
            Input::flashOnly('title', 'description', 'privacy', 'term');
            return Redirect::to('admin/quiz-contest/quiz/edit/'.$quizId)->withErrors($validation);
        }

        // Validation has succeeded. Create new quiz.

        // receive banner image
        $file = Input::file('banner'); // your file upload input field in the form should be named 'file'
        $uploadSuccess = false;
        if ($file) {
            $destinationPath = app_path().'/assets/uploads/admin/quiz-contest/';
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            $filename = uniqid().'.'.$extension;
            $uploadSuccess = Input::file('banner')->move($destinationPath, $filename);
            if ($uploadSuccess == null) {
                $filename = $quiz->banner;
            }
        } else {
            $filename = $quiz->banner;
        }

        // receive background image
        $file = Input::file('background'); // your file upload input field in the form should be named 'file'
        $uploadBackground = false;
        if ($file) {
            $destinationPath = app_path().'/assets/uploads/admin/quiz-contest/';
            // $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //if you need extension of the file
            $filenameBG = uniqid().'.'.$extension;
            $uploadBackground = Input::file('background')->move($destinationPath, $filenameBG);
            if ($uploadBackground == null) {
                $filenameBG = $quiz->background;
            }
        } else {
            $filenameBG = $quiz->background;
        }

        $quiz->title = Input::get('title');
        $quiz->description = Input::get('description');
        $quiz->privacy = Input::get('privacy');
        $quiz->term = Input::get('term');
        $quiz->banner = $filename;
        $quiz->background = $filenameBG;
        $quiz->save();

        // update schedule
        $schedule = QuizSchedule::where('quiz_id', $quiz->id)->get()->first();
        //var_dump($schedule);return;
        if ($schedule) {
            //
            $schedule->name = $quiz->title;
            $schedule->start_time = Input::get('schedule');
            $schedule->interval = 24;
            $schedule->status = 1;
            $schedule->quiz_id = $quiz->id;
            $schedule->save();
        } else {
            $schedule = new QuizSchedule;
            $schedule->name = $quiz->title;
            $schedule->start_time = Input::get('schedule');
            $schedule->interval = 24;
            $schedule->status = 1;
            $schedule->quiz_id = $quiz->id;
            $schedule->save();
        }


        return Redirect::to('admin/quiz-contest/');


    }

    public function getList() {
        $quizs = Quiz::with(array('questions', 'schedule'))->get();
        return View::make('admin.quiz.quiz-list')->with(array("quizs"=>$quizs));
    }

    public function getCreate() {
        return View::make('admin.quiz.quiz-create');
    }

    public function lock() {
        $quizId = Input::get('quizId');
        $quiz = Quiz::find($quizId);

        if ($quiz->id) {
            $quiz->status = 0;
            $quiz->save();
        }

        return Redirect::to('admin/quiz-contest/');
    }

    public function unlock() {
        $quizId = Input::get('quizId');
        $quiz = Quiz::find($quizId);

        if ($quiz->id) {
            $quiz->status = 1;
            $quiz->save();
        }

        return Redirect::to('admin/quiz-contest/');
    }

}