<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('i_employee', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('username')->unique();
			$table->string('password');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
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
		Schema::drop('i_employee');
	}

}
