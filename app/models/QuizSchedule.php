<?php

class QuizSchedule extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quiz_schedules';
}