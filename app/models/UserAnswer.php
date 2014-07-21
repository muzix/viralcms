<?php

class UserAnswer extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'user_answers';

    public function question()
    {
        return $this->belongsTo('QuizQuestion', 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}