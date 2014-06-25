<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users', function($table)
        {
        	$table->index('fbid');
        });
		Schema::create('invitations', function($table)
        {
            $table->increments('id')->unsigned();
            $table->bigInteger('from_id')->unsigned();
            $table->bigInteger('to_id')->unsigned();
            $table->string('to_name')->nullable();
            $table->string('code');
            $table->timestamps();
            $table->foreign('from_id')->references('fbid')->on('users');
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
		Schema::table('invitations', function(Blueprint $table) {
            $table->dropForeign('invitations_from_id_foreign');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropIndex('users_fbid_index');
        });
		Schema::drop('invitations');
	}

}
