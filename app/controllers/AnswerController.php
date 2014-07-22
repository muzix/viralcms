<?php

class AnswerController extends \BaseController {

	public function answer() {
		$rules = array(
            'fullname' => 'required',
            'email'    => 'required|email',
            'address' => 'required',
            'phone' => 'required|digits_between:0,20',
            'answer' => 'required',
            'term-accept' => 'required',
        );

        $messages = array(
            'fullname.required' => 'Phần Họ tên không được để trống.',
            'email.required' => 'Phần email không được để trống.',
            'address.required' => 'Phần Địa chỉ không được để trống.',
            'phone.required' => 'Phần Điện thoại không được để trống.',
            'answer.required' => 'Phần Trả lời không được để trống.',
            'term-accept.required' => 'Bạn cần đồng ý với thể lệ và điều khoản chương trình.',
            //'required' => 'Phần :attribute không được để trống.',
            'email.email' => 'Email phải hợp lệ.',
            //'fullname.alpha_num' => 'Họ tên chỉ chứa chữ số và chữ cái',
            'phone.digits_between' => 'Số điện thoại không hợp lệ'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails())
        {
            // Validation has failed.
            // Input::flashOnly('fullname', 'email', 'address', 'phone', 'answer', 'term-accept');
            return Redirect::route('getQuizContest', array('userId' => Input::get('userId')))->withInput()->withErrors($validation);
        }

        // find user by fbId
        $user = User::find(Input::get('userId'));
        if ($user->id) {
            // Update user info
            $profile = UserProfile::where('user_id', $user->id)->get()->first();
            if ($profile) {
                $profile->phone = Input::get('phone');
                $profile->address = Input::get('address');
                $profile->save();
            } else {
                $profile = new UserProfile;
                $profile->address = Input::get('address');
                $profile->phone = Input::get('phone');
                $profile->user_id = $user->id;
                $profile->save();
            }

            $user->fullname = Input::get('fullname');
            $user->save();

            $questionId = Input::get('questionId');
            // submit answer
            $answer = new UserAnswer;
            $answer->user_id = $user->id;
            $answer->question_id = $questionId;
            $answer->answer = Input::get('answer');
            $answer->save();
            return View::make('apps.quizcontest.answered')->with(array('user' => $user));
        }

        return Response::make('Not Found', 404);
	}

     public function getList() {
        $questionId = Input::get('questionId', -1);
        if ($questionId == -1) {
            return Response::make('Not Found', 404);
        }

        $answers = UserAnswer::with('user')->where('question_id', $questionId)->get();
        return View::make('admin.quiz.answer-list')->with(array('answers' => $answers));
    }

}