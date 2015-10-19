<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRAgencyHospitalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('r_agency_hospital', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('hospital_id')->unsigned()->index('r_agency_hospital_hospital_id_foreign');
			$table->integer('agency_id')->unsigned()->index('r_agency_hospital_agency_id_foreign');
			$table->text('memo', 65535)->nullable();
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
		Schema::drop('r_agency_hospital');
	}

}
