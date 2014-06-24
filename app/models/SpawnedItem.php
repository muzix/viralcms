<?php

class SpawnedItem extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'spawned_items';

	public function user()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('Item', 'item_id', 'id');
    }

    public function location()
    {
    	return $this->belongsTo('Location', 'location_id', 'id');
    }

    public function userTracking()
    {
        return $this->belongsTo('UserTracking', 'id', 'spawned_item_id');
    }

    public function getValidFromAttribute() 
    {
    	$unixEpoch = strtotime($this->attributes['valid_from']);
    	return $unixEpoch;
    }

    public function getValidUntilAttribute()
    {
        $unixEpoch = strtotime($this->attributes['valid_until']);
    	return $unixEpoch;
    }

}
