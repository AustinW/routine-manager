<?php

class UserTableSeeder extends \Illuminate\Database\Seeder
{
	public function run()
	{
        // First delete everything in the table
        // DB::statement('TRUNCATE TABLE users');

		$users = [
			[
				"email" => "austingym@gmail.com",
				"password" => "developer",
				"first_name" => "Austin",
				"last_name" => "White",
				"verified_at" => DB::raw('NOW()'),
			],
		];

		foreach ($users as $user) {
			User::create($user);
		}
	}
}