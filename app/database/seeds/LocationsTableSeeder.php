<?php

class LocationsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('locations')->truncate();

		$locations = array(
			array(
				"id" => 1,
				"name" => "anywhere",
				"description" => "anywhere",
				"latitude" => 21.019738,
				"longitude" => 105.802368,
				"radius" => 9999999,
				'created_at' => null
			),
			array(
				"id" => 2,
				"name" => "850 Đường Láng",
				"description" => "VTVcab R&D",
				"latitude" => 21.019738,
				"longitude" => 105.802368,
				"radius" => 1,
				'created_at' => null
			)
		);

		// Uncomment the below to run the seeder
		DB::table('locations')->insert($locations);
	}

}
