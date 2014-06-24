<?php

class Items_distributionTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('items_distribution')->truncate();
		$items_distribution = array(
			array(
				'location_id' => 1,
				'item_id' => 1,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 2,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 3,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 4,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 5,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 6,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 7,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 8,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 9,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 10,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 11,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 12,
				'percentage' => 8.00,
				'created_at' => null
			),
			array(
				'location_id' => 1,
				'item_id' => 13,
				'percentage' => 4.00,
				'created_at' => null
			),
			array(
				'location_id' => 0,
				'item_id' => 1,
				'percentage' => 30.00,
				'created_at' => null
			),
			array(
				'location_id' => 0,
				'item_id' => 2,
				'percentage' => 30.00,
				'created_at' => null
			),
			array(
				'location_id' => 0,
				'item_id' => 4,
				'percentage' => 20.00,
				'created_at' => null
			),
			array(
				'location_id' => 0,
				'item_id' => 5,
				'percentage' => 20.00,
				'created_at' => null
			)
		);

		// Uncomment the below to run the seeder
		DB::table('items_distribution')->insert($items_distribution);
	}

}
