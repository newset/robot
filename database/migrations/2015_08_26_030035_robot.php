<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Robot extends Migration
{
    public $ins_name = 'robot';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_' . $this->ins_name, function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->string('cust_id')->unique();
            $t->dateTime('production_date');
            $t->unsignedInteger('employee_id');
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('employee_id')->references('id')->on('i_employee')->onDelete('cascade');
        });

        $count = 1000;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'production_date'            => \Carbon\Carbon::now(),
                    'cust_id'         => uniqid(),
                    'employee_id'         => rand(1, 100),
                    'memo'            => str_random(500),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
