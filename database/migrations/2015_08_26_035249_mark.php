<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $ins_name = 'mark';


    public function up()
    {
        Schema::create('i_' . $this->ins_name, function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->string('cust_id')->unique();
            $t->smallInteger('status')->default(1);
            $t->smallInteger('sold')->default(0);
            $t->unsignedInteger('replacement_id')->nullable();
            $t->unsignedInteger('doctor_id')->nullable();
            $t->unsignedInteger('agency_id');
            $t->unsignedInteger('hospital_id')->nullable();
            $t->unsignedInteger('robot_id')->nullable();
            $t->string('surgery_type')->nullable();
            $t->dateTime('surgery_at')->nullable();
            $t->unsignedInteger('patient_id')->nullable();
            $t->dateTime('sold_at')->nullable();
            $t->dateTime('used_at')->nullable();
            $t->dateTime('damaged_at')->nullable();
            $t->dateTime('archive_at')->nullable();
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            //$t->foreign('replacement_id')->references('id')->on('i_mark');
            $t->foreign('doctor_id')->references('id')->on('i_doctor')->onDelete('cascade');
            $t->foreign('agency_id')->references('id')->on('i_agency')->onDelete('cascade');
            $t->foreign('hospital_id')->references('id')->on('i_hospital')->onDelete('cascade');
            $t->foreign('robot_id')->references('id')->on('i_robot')->onDelete('cascade');

        });

        $count = 3000;
        $d = [];

        function sold_at($used_at)
        {
            if ($used_at)
            {
                return date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208));
            }
            return null;
        }

        //function replacement_id()
        //{
        //    if ( ! empty($d['damaged_at']))
        //    {
        //        $rand_id = [null, rand(1, 3000)];
        //        return $rand_id[rand(0, count($rand_id) - 1)];
        //    }
        //    return null;
        //}

        for ($i = 0; $i < $count; $i++)
        {
            $status_set = [-1, 2, 3, 4];
            $sold_set = [0, 1];
            $rand_date = [null, date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208))];
            //$sold_date = date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208));
            //$damaged_at = [null, date($sold_date + rand(190000, 390000))];

            $d = [
                'cust_id'        => uniqid(),
                'status'         => rand(1, 4),
                'replacement_id' => rand(1, 3000),
                //'sold' => $sold_set[array_rand($sold_set)],
                'used_at'        => ($used_at = $rand_date[rand(0, count($rand_date) - 1)]),
                'sold_at'        => sold_at($used_at),
                //'replacement_id' => rand(1, $i - 1),
                'damaged_at'     => $rand_date[rand(0, count($rand_date) - 1)],
                'robot_id'       => rand(1, 1000),
                'agency_id'      => rand(1, 1000),
                'doctor_id'    => rand(1, 500),
                'hospital_id'    => rand(1, 400),
                'memo'           => str_random(500),
            ];


            db_c($this->ins_name, 'i', $d);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('i_' . $this->ins_name);
    }
}
