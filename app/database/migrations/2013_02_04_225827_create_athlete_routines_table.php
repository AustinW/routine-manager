<?php

use Illuminate\Database\Migrations\Migration;

class CreateAthleteRoutinesTable extends Migration {
	
	public static $routineTypes = array(
		'tra_prelim_compulsory', 'tra_prelim_optional', 'tra_semi_final_optional', 'tra_final_optional',
		'sync_prelim_compulsory', 'sync_prelim_optional', 'sync_final_optional',
		'dmt_pass_1', 'dmt_pass_2', 'dmt_pass_3', 'dmt_pass_4',
		'tum_pass_1', 'tum_pass_2', 'tum_pass_3', 'tum_pass_4',
	);
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('athlete_routines', function($table)
		{
			$table->increments('id');
			$table->integer('athlete_id')->unsigned()->index();
			$table->integer('routine_id')->unsigned()->index();
			$table->enum('routine_type', self::$routineTypes)->index();

			$table->timestamps();

			$table->unique(array('athlete_id', 'routine_id', 'routine_type'));

			$table->foreign('athlete_id')->references('id')->on('athletes');
			$table->foreign('routine_id')->references('id')->on('routines');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('athlete_routines');
	}

}