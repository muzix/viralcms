<?php

use Illuminate\Database\Migrations\Migration;

class UserLoginHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('user_login_history', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamp('login_at')->default('0000-00-00 00:00:00');
			$table->timestamp('logout_at')->default('0000-00-00 00:00:00');
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
		Schema::drop('user_login_history');
	}

}