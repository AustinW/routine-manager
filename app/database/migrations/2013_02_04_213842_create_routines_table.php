<?php

use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routines', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('name', 50);
			$table->string('description')->nullable();
			$table->boolean('locked')->default(0);

            $table->softDeletes();

			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('routines');
	}

}