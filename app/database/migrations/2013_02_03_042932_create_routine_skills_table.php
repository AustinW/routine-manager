<?php

use Illuminate\Database\Migrations\Migration;

class CreateRoutineSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routine_skills', function($table)
		{
			$table->increments('id');
			$table->integer('skill_id')->unsigned()->index();
			$table->integer('order_index')->unsigned();
			// $table->enum('position', ['mounter', 'spotter', 'dismount'])->nullable();

			// $table->timestamps();

			$table->foreign('skill_id')->references('id')->on('skills');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('routine_skills');
	}

}