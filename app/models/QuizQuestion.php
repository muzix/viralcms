<?php

class QuizQuestion extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quiz_questions';

    public function quiz()
    {
        return $this->belongsTo('Quiz', 'quiz_id', 'id');
    }

    public function questionAttributes() {
		return $this->hasMany('QuizQuestionAttribute', 'quiz_question_id', 'id');
	}

    public function answers() {
        return $this->hasMany('UserAnswer', 'question_id', 'id');
    }

}