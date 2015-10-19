<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIRobotLeaseLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('i_robot_lease_log', function(Blueprint $table)
		{
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
		Schema::table('i_robot_lease_log', function(Blueprint $table)
		{
			$table->dropForeign('i_robot_lease_log_robot_id_foreign');
		});
	}

}
