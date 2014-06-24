<?php

class Voucher extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'voucher';

	public function userTracking()
    {
        return $this->belongsTo('UserTracking', 'user_tracking_id', 'id');
    }
}
