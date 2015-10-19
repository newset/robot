<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIRobotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_robot', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cust_id')->unique();
			$table->date('production_date');
			$table->integer('employee_id')->unsigned()->index('i_robot_employee_id_foreign');
			$table->text('memo', 65535)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->boolean('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('i_robot');
	}

}
