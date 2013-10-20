<?php

use Illuminate\Database\Migrations\Migration;

class CreateAthleteRoutinesTable extends Migration {

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
			$table->integer('athlete_id')->index();
			$table->integer('routineable_id')->index();
			$table->string('routineable_type', 30)->index();
			$table->timestamps();

//			$table->foreign('athlete_id')->references('id')->on('athletes');
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