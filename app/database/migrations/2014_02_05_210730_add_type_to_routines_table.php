<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeToRoutinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('routines', function(Blueprint $table) {
			$table->enum('type', array('trampoline', 'doublemini', 'tumbling', 'synchro'))->after('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('routines', function(Blueprint $table) {
			$table->dropColumn('type');
		});
	}

}
