<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateILogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('at');
			$table->integer('action_type_id')->unsigned();
			$table->integer('ins_type_id')->unsigned();
			$table->integer('related_id')->unsigned();
			$table->integer('operator_type')->unsigned();
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
		Schema::drop('i_log');
	}

}
