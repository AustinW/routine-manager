<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRoutineIdToRoutineSkillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('routine_skill', function(Blueprint $table) {
			$table->integer('routine_id')->unsigned()->index()->after('skill_id');

			$table->foreign('routine_id')->references('id')->on('routines')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('routine_skill', function(Blueprint $table) {
			$table->dropColumn('routine_id');

			$table->dropForeign('routine_skill_routine_id_foreign');
		});
	}

}
