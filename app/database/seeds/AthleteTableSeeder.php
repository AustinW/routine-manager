<?php

class AthleteTableSeeder extends \Illuminate\Database\Seeder
{
	public function run()
	{
        // First delete everything in the table
        // DB::statement('TRUNCATE TABLE athletes');

		$athletes = [
			[
				"first_name" => "Austin",
				"last_name" => "White",
				"gender" => "male",
				"birthday" => "1988-05-20",
				"trampoline_level" => "sr",
				"doublemini_level" => "sr",
			],
		];

        $user = User::find(1);

		foreach ($athletes as $athlete) {
            $athlete = App::make('Athlete')->fill($athlete);

			$user->athletes()->save($athlete);
		}
	}
}