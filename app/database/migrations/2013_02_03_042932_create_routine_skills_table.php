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
			$table->integer('skillable_id')->index();
			$table->string('skillable_type', 20)->index();
			$table->integer('skill_id')->index();
			$table->integer('order_index');
			$table->enum('position', ['mounter', 'spotter', 'dismount'])->nullable();

			$table->timestamps();

//			$table->foreign('skill_id')->references('id')->on('skills');
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