<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('photos', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('invitation_id')->unsigned();
            $table->string('file');
            $table->timestamps();
            $table->foreign('invitation_id')->references('id')->on('invitations');
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
        Schema::table('photos', function(Blueprint $table) {
            $table->dropForeign('photos_invitation_id_foreign');
        });
        Schema::drop('photos');
	}

}
