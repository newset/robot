<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIAgencyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_agency', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 65535);
			$table->text('name_in_charge', 65535);
			$table->integer('city_id')->default(0);
			$table->integer('province_id')->default(0);
			$table->text('location_detail', 65535);
			$table->string('username')->unique();
			$table->string('password');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->date('started_at')->nullable();
			$table->date('ended_at')->nullable();
			$table->smallInteger('status')->default(1);
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
		Schema::drop('i_agency');
	}

}
