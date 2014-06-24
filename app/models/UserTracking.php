<?php

class UserTracking extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'user_tracking';

	public function spawnedItem()
    {
        return $this->hasOne('SpawnedItem', 'id', 'spawned_item_id');
    }

    public function voucher()
    {
    	return $this->hasOne('Voucher', 'id', 'voucher_id');
    }
}
