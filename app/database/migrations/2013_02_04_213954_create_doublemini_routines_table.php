<?php

use Illuminate\Database\Migrations\Migration;

class CreateDoubleminiRoutinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doublemini_routines', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->string('name', 50);
			$table->string('description')->nullable();
			$table->boolean('locked')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('doublemini_routines');
	}

}