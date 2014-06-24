<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('events', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('codename');
			$table->string('name');
			$table->string('short_description');
			$table->string('long_description');
			$table->timestamp('start_time')->default('0000-00-00 00:00:00');
			$table->timestamp('end_time')->default('0000-00-00 00:00:00');
			$table->timestamp('created_at')->default('0000-00-00 00:00:00');
			$table->timestamp('updated_at')->default(DB::raw('NOW()'))->update(DB::RAW('NOW()'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('events');
	}

}