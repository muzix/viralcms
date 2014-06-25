<?php

class Invitation extends \Eloquent {
	protected $fillable = [];

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'invitations';
}