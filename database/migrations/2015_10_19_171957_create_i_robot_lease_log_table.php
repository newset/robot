<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIRobotLeaseLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_robot_lease_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lease_type_id')->default(-1);
			$table->dateTime('lease_started_at');
			$table->dateTime('lease_ended_at');
			$table->integer('robot_id')->unsigned()->index('i_robot_lease_log_robot_id_foreign');
			$table->integer('agency_id')->default(-1)->index('i_robot_lease_log_agency_id_foreign');
			$table->integer('hospital_id')->default(-1)->index('i_robot_lease_log_hospital_id_foreign');
			$table->text('memo', 65535)->nullable();
			$table->softDeletes();
			$table->timestamps();
			$table->integer('recent')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('i_robot_lease_log');
	}

}
