<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIMarkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_mark', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cust_id')->unique();
			$table->smallInteger('status')->default(1);
			$table->string('cmid')->nullable();
			$table->smallInteger('sold')->default(0);
			$table->integer('replacement_id')->unsigned()->nullable();
			$table->integer('doctor_id')->nullable()->index('i_mark_doctor_id_foreign');
			$table->integer('agency_id')->nullable()->index('i_mark_agency_id_foreign');
			$table->integer('hospital_id')->nullable()->index('i_mark_hospital_id_foreign');
			$table->integer('robot_id')->nullable()->index('i_mark_robot_id_foreign');
			$table->string('ddid_usb')->nullable();
			$table->string('surgery_type')->nullable();
			$table->dateTime('surgery_at')->nullable();
			$table->string('patient_name')->nullable();
			$table->dateTime('sold_at')->nullable();
			$table->dateTime('used_at')->nullable();
			$table->dateTime('damaged_at')->nullable();
			$table->dateTime('archive_at')->nullable();
			$table->text('memo', 65535)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->dateTime('shipped_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('i_mark');
	}

}
