<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser {

	use HasRole;

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'users';

}