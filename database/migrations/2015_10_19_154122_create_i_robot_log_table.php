<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIRobotLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_robot_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('action_type')->default(1);
			$table->integer('robot_id')->unsigned()->index('i_robot_log_robot_id_foreign');
			$table->integer('employee_id')->unsigned()->index('i_robot_log_employee_id_foreign');
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
		Schema::drop('i_robot_log');
	}

}
