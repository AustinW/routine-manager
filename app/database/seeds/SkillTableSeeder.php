<?php

class SkillTableSeeder extends \Illuminate\Database\Seeder
{
	public function run()
	{
        // First delete everything in the table (Mongo)
        // DB::collection('skills')->delete();

		$skills = [
			[
				"name" => "Double Back Tuck",
				"trampoline_difficulty" => 1.0,
				"doublemini_difficulty" => 2.0,
				"tumbling_difficulty" => 2.0,
				"fig" => "8.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Barani Out Tuck",
				"trampoline_difficulty" => 1.1,
				"doublemini_difficulty" => 2.4,
				"tumbling_difficulty" => 2.2,
				"fig" => "8.0.1 o",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "3/4 Front",
				"trampoline_difficulty" => 0.3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.0 /",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Arabian 3/4 Front",
				"trampoline_difficulty" => 0.4,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.1.0 /",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Front Tuck",
				"trampoline_difficulty" => 0.5,
				"doublemini_difficulty" => 0.5,
				"tumbling_difficulty" => 0.5,
				"fig" => "4.0 o",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Front Pike",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.0 <",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Front Straight",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.0 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Barani Tuck",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.7,
				"tumbling_difficulty" => 0,
				"fig" => "4.1 o",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Barani Pike",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.7,
				"tumbling_difficulty" => 0,
				"fig" => "4.1 <",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Barani Straight",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.7,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.1 /",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Ballout",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.0 o",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Barani Ballout Straight",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.1 /",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Rudi Ballout",
				"trampoline_difficulty" => 0.9,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.3 /",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Front Full",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0.9,
				"tumbling_difficulty" => 0,
				"fig" => "4.2 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Rudi",
				"trampoline_difficulty" => 0.8,
				"doublemini_difficulty" => 1.2,
				"tumbling_difficulty" => 0,
				"fig" => "4.3 /",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Front Double Full",
				"trampoline_difficulty" => 0.9,
				"doublemini_difficulty" => 1.5,
				"tumbling_difficulty" => 0,
				"fig" => "4.4 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Randy",
				"trampoline_difficulty" => 1.0,
				"doublemini_difficulty" => 1.9,
				"tumbling_difficulty" => 0,
				"fig" => "4.5 /",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "1 3/4 Front Tuck",
				"trampoline_difficulty" => 0.8,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "7.0.0 o",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "1 3/4 Front Pike",
				"trampoline_difficulty" => 0.9,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "7.0.0 <",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Double Front Tuck",
				"trampoline_difficulty" => 1.0,
				"doublemini_difficulty" => 2.0,
				"tumbling_difficulty" => 2.0,
				"fig" => "8.0.0 o",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Double Front Pike",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.4,
				"tumbling_difficulty" => 2.2,
				"fig" => "8.0.0 <",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Double Front Straight",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 2.4,
				"fig" => "8.0.0 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Barani Out Pike",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 2.4,
				"fig" => "8.0.1 <",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Full Barani Tuck",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.1 o",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Full Barani Straight",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.1 /",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Rudi Out Tuck",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.3 o",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Rudi Out Pike",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.3 <",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Triffis Tuck",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 5.1,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.0.1 o",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Triffis Pike",
				"trampoline_difficulty" => 2.0,
				"doublemini_difficulty" => 5.9,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.0.1 <",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "3/4 Back Straight",
				"trampoline_difficulty" => 0.3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.0 /",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Back Tuck",
				"trampoline_difficulty" => 0.5,
				"doublemini_difficulty" => 0.5,
				"tumbling_difficulty" => 0.5,
				"fig" => "4.0 o",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Back Pike",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.0 <",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Back Straight",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.0 /",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Cody Tuck",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.0 o",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Cody Pike",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.0 <",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Cody Straight",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.0 /",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Cody Full",
				"trampoline_difficulty" => 0.8,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.2 /",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Back Full",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0.9,
				"tumbling_difficulty" => 0.7,
				"fig" => "4.2 /",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Back 1 1/2",
				"trampoline_difficulty" => 0.8,
				"doublemini_difficulty" => 1.2,
				"tumbling_difficulty" => 0.9,
				"fig" => "4.3 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Back Double Full",
				"trampoline_difficulty" => 0.9,
				"doublemini_difficulty" => 1.5,
				"tumbling_difficulty" => 1.1,
				"fig" => "4.4 /",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Back Triple Full",
				"trampoline_difficulty" => 1.1,
				"doublemini_difficulty" => 2.3,
				"tumbling_difficulty" => 1.7,
				"fig" => "4.6 /",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "1 3/4 Back Tuck",
				"trampoline_difficulty" => 0.8,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "7.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "1 3/4 Back Pike",
				"trampoline_difficulty" => 0.9,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "7.0.0 <",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Double Back Pike",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.4,
				"tumbling_difficulty" => 2.2,
				"fig" => "8.0.0 <",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Double Back Straight",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 2.4,
				"fig" => "8.0.0 /",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full Out Tuck",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.2 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full Out Straight",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.2 /",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full Full Tuck",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 3.2,
				"fig" => "8.2.2 o",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Full Full Straight",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.4,
				"tumbling_difficulty" => 3.6,
				"fig" => "8.2.2 /",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Half Half Tuck",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.1 o",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Half Half Pike",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.1 <",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Half Rudi Tuck",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.3 o",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Half Rudi Pike",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.3 <",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Randy Out Tuck",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.5 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Randy Out Pike",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 4.4,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.5 <",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Randy Ballout",
				"trampoline_difficulty" => 1.1,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.5 /",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Miller Straight",
				"trampoline_difficulty" => 1.8,
				"doublemini_difficulty" => 5.2,
				"tumbling_difficulty" => 4.8,
				"fig" => "8.2.4 /",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Miller Pike",
				"trampoline_difficulty" => 1.8,
				"doublemini_difficulty" => 4.8,
				"tumbling_difficulty" => 4.6,
				"fig" => "8.2.4 <",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Double Cody Tuck",
				"trampoline_difficulty" => 1.1,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "9.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Half Triffis Tuck",
				"trampoline_difficulty" => 1.8,
				"doublemini_difficulty" => 5.7,
				"tumbling_difficulty" => 0,
				"fig" => "12.1.0.1 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Half Triffis Pike",
				"trampoline_difficulty" => 2.1,
				"doublemini_difficulty" => 6.5,
				"tumbling_difficulty" => 0,
				"fig" => "12.1.0.1 <",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Barani Out Ballout Tuck",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "9.0.1 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Barani Out Ballout Pike",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "9.0.1 <",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Full Rudi Straight",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 4.8,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.3 /",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Miller Tuck",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.4,
				"tumbling_difficulty" => 4.4,
				"fig" => "8.2.4 o",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Barani Full Tuck",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.2 o",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Barani Full Pike",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.2 <",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Barani Full Straight",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 0,
				"fig" => "8.1.2 /",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Full Barani Pike",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.1 <",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "3/4 Back Tuck",
				"trampoline_difficulty" => 0.3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.0 o",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "3/4 Back Pike",
				"trampoline_difficulty" => 0.3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.0 <",
				"flip_direction" => "b",
				"occurrence" => 2
			],
			[
				"name" => "Triffis Rudi Out Pike",
				"trampoline_difficulty" => 2.2,
				"doublemini_difficulty" => 7.1,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.0.3 <",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Triffis Rudi Out Tuck",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 6.3,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.0.3 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Half Triffis Rudi Out Pike",
				"trampoline_difficulty" => 2.3,
				"doublemini_difficulty" => 7.7,
				"tumbling_difficulty" => 0,
				"fig" => "12.1.0.3 <",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Half Triffis Rudi Out Tuck",
				"trampoline_difficulty" => 2.0,
				"doublemini_difficulty" => 6.9,
				"tumbling_difficulty" => 0,
				"fig" => "12.1.0.3 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Full Full Barani Tuck",
				"trampoline_difficulty" => 2.1,
				"doublemini_difficulty" => 7.5,
				"tumbling_difficulty" => 0,
				"fig" => "12.2.2.1 o",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Full Full Full Tuck",
				"trampoline_difficulty" => 2.2,
				"doublemini_difficulty" => 8.1,
				"tumbling_difficulty" => 0,
				"fig" => "12.2.2.2 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Triple Back Tuck",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.5,
				"tumbling_difficulty" => 4.5,
				"fig" => "12.0.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Triple Back Pike",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 5.3,
				"tumbling_difficulty" => 5.1,
				"fig" => "12.0.0.0 <",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Triple Back Straight",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 6.1,
				"tumbling_difficulty" => 5.7,
				"fig" => "12.0.0.0 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Quadruple Back Tuck",
				"trampoline_difficulty" => 2.2,
				"doublemini_difficulty" => 8.0,
				"tumbling_difficulty" => 8,
				"fig" => "16.0.0.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Quaffis Tuck",
				"trampoline_difficulty" => 2.3,
				"doublemini_difficulty" => 8.8,
				"tumbling_difficulty" => 0,
				"fig" => "16.0.0.0.1 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Quaffis Pike",
				"trampoline_difficulty" => 2.7,
				"doublemini_difficulty" => 10.0,
				"tumbling_difficulty" => 0,
				"fig" => "16.0.0.0.1 <",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Arabian Front Tuck",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.6,
				"fig" => "4.1 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Arabian Front Pike",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.6,
				"tumbling_difficulty" => 0.7,
				"fig" => "4.1 <",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Arabian Front Straight",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0.7,
				"tumbling_difficulty" => 0,
				"fig" => "4.1 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Barani Ballout Tuck",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.1 o",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Barani Ballout Pike",
				"trampoline_difficulty" => 0.7,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.1 <",
				"flip_direction" => "f",
				"occurrence" => 2
			],
			[
				"name" => "Cruise",
				"trampoline_difficulty" => .3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "2.1 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Return to feet",
				"trampoline_difficulty" => .1,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "1.0 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Straddle Jump",
				"trampoline_difficulty" => 0.0,
				"doublemini_difficulty" => 0.0,
				"tumbling_difficulty" => 0,
				"fig" => "S",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Pike Jump",
				"trampoline_difficulty" => 0.0,
				"doublemini_difficulty" => 0.0,
				"tumbling_difficulty" => 0,
				"fig" => "P",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Tuck Jump",
				"trampoline_difficulty" => 0.0,
				"doublemini_difficulty" => 0.0,
				"tumbling_difficulty" => 0,
				"fig" => "T",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Back 1 1/4 Tuck",
				"trampoline_difficulty" => 0.6,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "5.0 o",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Back Pullover",
				"trampoline_difficulty" => 0.3,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "3.0 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Airplane",
				"trampoline_difficulty" => 0.2,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "1.1 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Stomach to Back",
				"trampoline_difficulty" => 0.2,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "2.0 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Full Turn",
				"trampoline_difficulty" => 0.2,
				"doublemini_difficulty" => 0.0,
				"tumbling_difficulty" => 0,
				"fig" => "0.2 /",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Seat Drop",
				"trampoline_difficulty" => 0.0,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "L",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Swivel Hips",
				"trampoline_difficulty" => 0.1,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => 0,
				"fig" => "0.1 L",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Half Randy Pike",
				"trampoline_difficulty" => 1.8,
				"doublemini_difficulty" => 4.8,
				"tumbling_difficulty" => 4.8,
				"fig" => "8.1.5 <",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Half Randy Tuck",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.4,
				"tumbling_difficulty" => 4.4,
				"fig" => "8.1.5 o",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Mid Full Triffis Pike",
				"trampoline_difficulty" => 2.2,
				"doublemini_difficulty" => 7.1,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.2.1 <",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Mid Full Triffis Tuck",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 6.3,
				"tumbling_difficulty" => 0,
				"fig" => "12.0.2.1 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Miller Plus Straight",
				"trampoline_difficulty" => 2.0,
				"doublemini_difficulty" => 6.0,
				"tumbling_difficulty" => 6.0,
				"fig" => "8.2.6 /",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Miller Plus Tuck",
				"trampoline_difficulty" => 2.0,
				"doublemini_difficulty" => 5.2,
				"tumbling_difficulty" => 5.2,
				"fig" => "8.2.6 o",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Full Randy Straight",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 5.6,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.5 /",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Full Randy Tuck",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 4.8,
				"tumbling_difficulty" => 0,
				"fig" => "8.2.5 o",
				"flip_direction" => "f",
				"occurrence" => 5
			],
			[
				"name" => "Randy Out Pike",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 4.4,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.5 <",
				"flip_direction" => "f",
				"occurrence" => 3
			],
			[
				"name" => "Randy Out Tuck",
				"trampoline_difficulty" => 1.5,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.5 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Full Full Pike",
				"trampoline_difficulty" => 1.6,
				"doublemini_difficulty" => 4.0,
				"tumbling_difficulty" => 4.0,
				"fig" => "8.2.2 <",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Adolf Out Pike",
				"trampoline_difficulty" => 1.9,
				"doublemini_difficulty" => 5.2,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.7 <",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Adolf Out Tuck",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 4.8,
				"tumbling_difficulty" => 0,
				"fig" => "8.0.7 o",
				"flip_direction" => "f",
				"occurrence" => 4
			],
			[
				"name" => "Round Off",
				"trampoline_difficulty" => 0,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => .2,
				"fig" => ")",
				"flip_direction" => "f",
				"occurrence" => 1
			],
			[
				"name" => "Backhandspring",
				"trampoline_difficulty" => 0,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => .2,
				"fig" => "F",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Whip",
				"trampoline_difficulty" => 0,
				"doublemini_difficulty" => 0,
				"tumbling_difficulty" => .3,
				"fig" => "^",
				"flip_direction" => "b",
				"occurrence" => 1
			],
			[
				"name" => "Back 2 1/2",
				"trampoline_difficulty" => 1,
				"doublemini_difficulty" => 1.9,
				"tumbling_difficulty" => 1.4,
				"fig" => "4.5 /",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Back Quad Full",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 3.3,
				"tumbling_difficulty" => 2.5,
				"fig" => "4.8 /",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Full In Tuck",
				"trampoline_difficulty" => 1.2,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 2.4,
				"fig" => "8.2.0 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full In Pike",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 2.6,
				"fig" => "8.2.0 <",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full In Straight",
				"trampoline_difficulty" => 1.4,
				"doublemini_difficulty" => 3.6,
				"tumbling_difficulty" => 2.8,
				"fig" => "8.2.0 /",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Arabian Triple Front Tuck",
				"trampoline_difficulty" => 1.7,
				"doublemini_difficulty" => 5.1,
				"tumbling_difficulty" => 5.4,
				"fig" => "12.1.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Arabian Triple Front Pike",
				"trampoline_difficulty" => 2.0,
				"doublemini_difficulty" => 5.9,
				"tumbling_difficulty" => 6.0,
				"fig" => "12.1.0.0 <",
				"flip_direction" => "b",
				"occurrence" => 5
			],
			[
				"name" => "Full In Triple Back Tuck",
				"trampoline_difficulty" => 1.8,
				"doublemini_difficulty" => 5.7,
				"tumbling_difficulty" => 6.3,
				"fig" => "12.2.0.0 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Full In Triple Back Pike",
				"trampoline_difficulty" => 2.1,
				"doublemini_difficulty" => 6.5,
				"tumbling_difficulty" => 6.9,
				"fig" => "12.2.0.0 <",
				"flip_direction" => "b",
				"occurrence" => 4
			],
			[
				"name" => "Back Half Out Tuck",
				"trampoline_difficulty" => 1.1,
				"doublemini_difficulty" => 2.4,
				"tumbling_difficulty" => 2.2,
				"fig" => "8.0.1 o",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Back Half Out Pike",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 2.8,
				"tumbling_difficulty" => 2.4,
				"fig" => "8.0.1 <",
				"flip_direction" => "b",
				"occurrence" => 3
			],
			[
				"name" => "Back Half Out Straight",
				"trampoline_difficulty" => 1.3,
				"doublemini_difficulty" => 3.2,
				"tumbling_difficulty" => 2.6,
				"fig" => "8.0.1 /",
				"flip_direction" => "b",
				"occurrence" => 3
			]
		];

		Redis::hdel('skills:name', '*');

		$fields = array_keys($skills[0]);

		array_map(function($skill) use($fields) {

			$skillObj = new Skill;

			// Import all of the fields
			foreach ($fields as $field) {
				$skillObj->$field = $skill[$field];
			}

			$skillObj->save();

            $slugName = $skill['name'];
            $slugFig = $skill['fig'];

            Redis::hset('skills:name:' . $slugName, 'id', $skillObj->_id);
            Redis::hset('skills:name:' . $slugName, 'name', $skillObj->name);
            Redis::hset('skills:name:' . $slugName, 'trampoline_difficulty', $skillObj->trampoline_difficulty);
            Redis::hset('skills:name:' . $slugName, 'doublemini_difficulty', $skillObj->doublemini_difficulty);
            Redis::hset('skills:name:' . $slugName, 'tumbling_difficulty', $skillObj->tumbling_difficulty);
            Redis::hset('skills:name:' . $slugName, 'fig', $skillObj->fig);
            Redis::hset('skills:name:' . $slugName, 'flip_direction', $skillObj->flip_direction);
            Redis::hset('skills:name:' . $slugName, 'occurrence', $skillObj->occurrence);

            Redis::set('skills:fig:' . $slugFig, 1);
		}, $skills);
	}
}