<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RAgencyHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_agency_hospital', function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->unsignedInteger('hospital_id');
            $t->unsignedInteger('agency_id');
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('hospital_id')->references('id')->on('i_hospital')->onDelete('cascade');
            $t->foreign('agency_id')->references('id')->on('i_agency')->onDelete('cascade');
        });

        $count = 1000;

        for ($i = 0; $i < $count; $i++)
        {
            DB::table('r_agency_hospital')->insert(
                [
                    'hospital_id' => rand(1, 400),
                    'agency_id'    => rand(1, 1000),
                    'memo'           => str_random(500),
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
