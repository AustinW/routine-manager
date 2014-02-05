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
			$levels = array_merge(range(1, 10), array('jr', 'sr'));

			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->enum('gender', ['male', 'female']);
			$table->date('birthday');
			$table->enum('trampoline_level', $levels)->nullable();
			$table->enum('doublemini_level', $levels)->nullable();
			$table->enum('tumbling_level', $levels)->nullable();
			$table->enum('synchro_level', $levels)->nullable();
			$table->text('notes');
			
			$table->timestamps();

			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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