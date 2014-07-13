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

}