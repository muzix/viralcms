<?php

class GameEvent extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'events';

	public function items() {
		return $this->hasMany('Item', 'event_id', 'id');
	}

    public function getStartTimeAttribute() 
    {
    	$unixEpoch = strtotime($this->attributes['start_time']);
    	return $unixEpoch;
    }

    public function getEndTimeAttribute()
    {
        $unixEpoch = strtotime($this->attributes['end_time']);
    	return $unixEpoch;
    }
}
