<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIDoctorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('i_doctor', function(Blueprint $table)
		{
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
		Schema::table('i_doctor', function(Blueprint $table)
		{
			$table->dropForeign('i_doctor_hospital_id_foreign');
		});
	}

}
