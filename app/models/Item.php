<?php

class Item extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'items';

	public function gameEvent()
    {
        return $this->belongsTo('GameEvent', 'event_id', 'id');
    }

    public function spawnedItems()
    {
    	return $this->hasMany('SpawnedItem', 'item_id', 'id');
    }

    public function distributions()
    {
    	return $this->hasMany('ItemsDistribution', 'item_id', 'id');
    }
}
