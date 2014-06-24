<?php

class ItemsDistribution extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'items_distribution';

	public function location()
    {
        return $this->belongsTo('Location', 'location_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('Item', 'item_id', 'id');
    }
}
