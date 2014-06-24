<?php

use Carbon\Carbon;

class EventsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('events')->truncate();

		$events = array(
			array(
				'codename' => 'SPIDER',
				'name' => 'Sưu tập card Người nhện siêu đẳng',
				'short_description' => 'Let\'s find The Amazing Spider-man\'s card',
				'long_description' => 'Let\'s find The Amazing Spider-man\'s card',
				'start_time' => Carbon::now(),
				'end_time' => Carbon::createFromDate(2014, 4, 30),
				'created_at' => null
			)
		);

		// Uncomment the below to run the seeder
		DB::table('events')->insert($events);
	}

}
