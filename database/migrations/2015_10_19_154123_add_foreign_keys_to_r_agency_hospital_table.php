<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRAgencyHospitalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('r_agency_hospital', function(Blueprint $table)
		{
			$table->foreign('agency_id')->references('id')->on('i_agency')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('hospital_id')->references('id')->on('i_hospital')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('r_agency_hospital', function(Blueprint $table)
		{
			$table->dropForeign('r_agency_hospital_agency_id_foreign');
			$table->dropForeign('r_agency_hospital_hospital_id_foreign');
		});
	}

}
