<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RobotLog extends Migration
{
    public $ins_name = 'robot_log';

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
            $t->integer('action_type_id')->default(1);
            $t->unsignedInteger('robot_id');
            $t->unsignedInteger('employee_id');
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('robot_id')->references('id')->on('i_robot')->onDelete('cascade');
            $t->foreign('employee_id')->references('id')->on('i_employee')->onDelete('cascade');
        });

        $count = 1000;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'employee_id'     => rand(1, 100),
                    'robot_id'        => rand(1, 1000),
                    'action_type_id'  => rand(1, 3),
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
