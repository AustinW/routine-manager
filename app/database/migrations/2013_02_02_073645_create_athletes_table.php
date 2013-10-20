<?php

use Illuminate\Database\Migrations\Migration;

class CreateAthletesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('athletes', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->enum('gender', ['male', 'female']);
			$table->date('birthday');
			$table->enum('trampoline_level', ['0','8','9','10','jr','sr'])->nullable();
			$table->enum('doublemini_level', ['0','8','9','10','jr','sr'])->nullable();
			$table->enum('tumbling_level', ['0','8','9','10','jr','sr'])->nullable();
			$table->enum('synchro_level', ['0','8','9','10','jr','sr'])->nullable();
			$table->text('notes');
			$table->timestamps();

			$table->softDeletes();

			// $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('athletes');
	}

}