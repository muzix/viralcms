<?php

class QuizQuestionType extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quiz_question_type';
}