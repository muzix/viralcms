<?php

class Quiz extends \Eloquent {
	protected $fillable = [];

    protected $guarded = array();

    public static $rules = array();

    protected $table = 'quizs';
}