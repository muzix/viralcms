<?php

class AdminsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('admins')->truncate();

		$admins = array(

			array(
				'email' => 'phamhuuhoang1210@gmail.com',
				'name' => 'Hoang Pham Huu',
				'password' => Hash::make('admin@galaxyfilm'),
				'created_at' => null
			)
		);

		// Uncomment the below to run the seeder
		DB::table('admins')->insert($admins);
	}

}
