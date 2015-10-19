<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIDoctorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_doctor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('hospital_id')->unsigned()->index('i_doctor_hospital_id_foreign');
			$table->integer('department_id')->unsigned()->index('i_doctor_department_id_foreign');
			$table->integer('cust_id')->default(0)->unique();
			$table->string('title');
			$table->integer('level');
			$table->text('memo', 65535)->nullable();
			$table->string('wechat_id')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->smallInteger('gender')->nullable()->default(1);
			$table->smallInteger('status')->default(1);
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
		Schema::drop('i_doctor');
	}

}
