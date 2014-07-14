<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('UserTableSeeder');
		//$this->call('EventsTableSeeder');
		//$this->call('LocationsTableSeeder');
		//$this->call('ItemsTableSeeder');
		//$this->call('Items_distributionTableSeeder');
		//$this->call('AdminsTableSeeder');
        $this->call('QuizQuestionAttrTypeTableSeeder');
	}

}