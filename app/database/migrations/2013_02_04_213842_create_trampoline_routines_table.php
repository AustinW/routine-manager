<?php

use Illuminate\Database\Migrations\Migration;

class CreateTrampolineRoutinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trampoline_routines', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->string('name', 50);
			$table->string('description')->nullable();
			$table->boolean('locked')->default(0);

            $table->softDeletes();
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
		Schema::drop('trampoline_routines');
	}

}