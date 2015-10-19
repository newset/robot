<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIRobotLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('i_robot_log', function(Blueprint $table)
		{
			$table->foreign('employee_id')->references('id')->on('i_employee')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('robot_id')->references('id')->on('i_robot')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('i_robot_log', function(Blueprint $table)
		{
			$table->dropForeign('i_robot_log_employee_id_foreign');
			$table->dropForeign('i_robot_log_robot_id_foreign');
		});
	}

}
