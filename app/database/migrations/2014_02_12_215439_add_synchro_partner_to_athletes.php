<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSynchroPartnerToAthletes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('athletes', function(Blueprint $table) {
			$table->integer('synchro_partner_id')->unsigned()->index()->after('user_id');

			// $table->foreign('synchro_partner_id')->references('id')->on('athletes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('athletes', function(Blueprint $table) {
			// $table->dropForeign('athletes_synchro_partner_athletes_id');

			$table->dropColumn('synchro_partner');
		});
	}

}
