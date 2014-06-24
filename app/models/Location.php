<?php

class Location extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'locations';

	public function spawnedItems()
    {
    	return $this->hasMany('SpawnedItem', 'location_id', 'id');
    }

    public function itemDistributions()
    {
    	return $this->hasMany('ItemsDistribution', 'location_id', 'id');
    }
}
