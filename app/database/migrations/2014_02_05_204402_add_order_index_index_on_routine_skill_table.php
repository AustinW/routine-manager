<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrderIndexIndexOnRoutineSkillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('routine_skill', function(Blueprint $table) {
			$table->index('order_index');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('routine_skill', function(Blueprint $table) {
			$table->dropIndex('order_index');
		});
	}

}
