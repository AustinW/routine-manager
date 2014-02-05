<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveTimestampsFromAthleteRoutineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('athlete_routine', function(Blueprint $table) {
			$table->dropColumn('created_at', 'updated_at');
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
			$table->timestamps();
		});
	}

}
