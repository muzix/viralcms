<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('quiz_status', function($table)
        {
            $table->increments('id');
            $table->string('status');
        });

        Schema::create('quizs', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->string('banner');
            $table->string('privacy');
            $table->string('term');
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('quiz_schedules', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('quiz_id')->unsigned();
            $table->timestamp('start_time');
            $table->integer('interval');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('quizs');
        });

        Schema::create('quiz_question_type', function($table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('quiz_questions', function($table){
            $table->increments('id')->unsigned();
            $table->integer('quiz_id')->unsigned();
            $table->integer('question_type_id')->unsigned();
            $table->string('question');
            $table->string('answer');
            $table->integer('priority');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('quizs');
            $table->foreign('question_type_id')->references('id')->on('quiz_question_type');
        });

        Schema::create('quiz_question_attr_type', function($table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('quiz_question_attr', function($table){
            $table->increments('id')->unsigned();
            $table->integer('quiz_question_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('content');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions');
            $table->foreign('type_id')->references('id')->on('quiz_question_attr_type');
        });

        Schema::create('user_answers', function($table){
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->string('answer');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('quiz_questions');
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
        Schema::table('user_answers', function(Blueprint $table) {
            $table->dropForeign('user_answers_user_id_foreign');
            $table->dropForeign('user_answers_question_id_foreign');
        });
        Schema::drop('user_answers');

        Schema::table('quiz_question_attr', function(Blueprint $table) {
            $table->dropForeign('quiz_question_attr_quiz_question_id_foreign');
            $table->dropForeign('quiz_question_attr_type_id_foreign');
        });
        Schema::drop('quiz_question_attr');

        Schema::drop('quiz_question_attr_type');

        Schema::table('quiz_questions', function(Blueprint $table) {
            $table->dropForeign('quiz_questions_quiz_id_foreign');
            $table->dropForeign('quiz_questions_question_type_id_foreign');
        });
        Schema::drop('quiz_questions');

        Schema::drop('quiz_question_type');

        Schema::table('quiz_schedules', function(Blueprint $table) {
            $table->dropForeign('quiz_schedules_quiz_id_foreign');
        });
        Schema::drop('quiz_schedules');
        Schema::drop('quizs');
        Schema::drop('quiz_status');
	}

}
