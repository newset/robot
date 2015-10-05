<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RobotLeaseLog extends Migration
{
    public $ins_name = 'robot_lease_log';

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
            $t->integer('lease_type_id')->default(1);
            $t->dateTime('lease_started_at');
            $t->dateTime('lease_ended_at');
            $t->unsignedInteger('robot_id');
            $t->unsignedInteger('agency_id');
            $t->unsignedInteger('hospital_id');
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('robot_id')->references('id')->on('i_robot')->onDelete('cascade');
            $t->foreign('agency_id')->references('id')->on('i_agency')->onDelete('cascade');
            $t->foreign('hospital_id')->references('id')->on('i_hospital')->onDelete('cascade');
        });

        $count = 5000;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'lease_type_id'    => rand(1, 4),
                    'lease_started_at' => date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208)),
                    'lease_ended_at'   => date("Y-m-d H:i:s", mt_rand(1440560208, 1640560208) + rand(190000, 390000)),
                    'hospital_id'      => rand(1, 400),
                    'robot_id'         => rand(1, 1000),
                    'agency_id'        => rand(1, 1000),
                    'memo'             => str_random(500),
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
