<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeUniqueIndexOnAthleteRoutineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('athlete_routine', function(Blueprint $table) {
			// $table->dropUnique('athlete_routines_athlete_id_routine_id_routine_type_unique');

			$table->unique(array('athlete_id', 'routine_type'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('athlete_routine', function(Blueprint $table) {
			$table->dropUnique('athlete_routine_athlete_id_routine_type_unique');

			$table->unique(array('athlete_id', 'routine_id', 'routine_type'));
		});
	}

}
