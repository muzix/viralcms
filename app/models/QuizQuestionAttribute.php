<?php

class QuizQuestionAttribute extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quiz_question_attr';

    public $timestamps = false;

    public function quizQuestion()
    {
        return $this->belongsTo('QuizQuestion', 'quiz_question_id', 'id');
    }
}