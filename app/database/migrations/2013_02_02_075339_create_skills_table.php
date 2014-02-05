<?php

use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skills', function($table)
		{
			$table->increments('id');
			$table->string('name', 50)->index();
			$table->float('trampoline_difficulty');
			$table->float('doublemini_difficulty');
			$table->float('tumbling_difficulty');
			$table->string('fig', 15)->index();
			$table->enum('flip_direction', ['f', 'b']);
			$table->tinyInteger('occurrence');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('skills');
	}

}