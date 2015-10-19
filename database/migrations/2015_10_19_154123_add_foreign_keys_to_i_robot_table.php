<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIRobotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('i_robot', function(Blueprint $table)
		{
			$table->foreign('employee_id')->references('id')->on('i_employee')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('i_robot', function(Blueprint $table)
		{
			$table->dropForeign('i_robot_employee_id_foreign');
		});
	}

}
