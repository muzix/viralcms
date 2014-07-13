<?php

class Quiz extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quizs';

    public function questions() {
		return $this->hasMany('QuizQuestion', 'quiz_id', 'id');
	}
}