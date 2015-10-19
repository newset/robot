<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIHospitalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_hospital', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 65535);
			$table->integer('city_id')->unsigned();
			$table->integer('province_id')->unsigned();
			$table->text('location_detail', 65535);
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
		Schema::drop('i_hospital');
	}

}
