<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTeamFieldToAthletesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('athletes', function(Blueprint $table) {
			$table->string('team', 50)->after('birthday');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('athletes', function(Blueprint $table) {
			$table->dropColumn('team');
		});
	}

}
