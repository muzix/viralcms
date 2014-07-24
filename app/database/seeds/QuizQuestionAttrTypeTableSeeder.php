<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuizQuestionAttrTypeTableSeeder extends Seeder {

	public function run()
	{
		$rows = array(
            array(
                "id" => 1,
                "name" => "youtube",
            )
        );

        // Uncomment the below to run the seeder
        DB::table('quiz_question_attr_type')->insert($rows);

        $rows = array(
            array(
                "id" => 1,
                "name" => "text",
            ),
            array(
                "id" => 2,
                "name" => "choice",
            )
        );

        DB::table('quiz_question_type')->insert($rows);
	}

}