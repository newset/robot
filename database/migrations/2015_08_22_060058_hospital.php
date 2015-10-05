<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $ins_name = 'hospital';


    public function up()
    {
        Schema::create('i_' . $this->ins_name, function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->text('name');
            $t->integer('city_id')->unsigned();
            $t->integer('province_id')->unsigned();
            $t->text('location_detail');
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();
        });

        db_c($this->ins_name, 'i',
            [
                'name'            => '自有',
                'city_id'         => rand(36, 398),
                'province_id'     => rand(2, 35),
                'location_detail' => str_random(100),
                'memo'            => str_random(500),
            ]
        );

        $count = 400;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'name'            => str_random(2) . '第' . $i . '医院',
                    'city_id'         => rand(36, 398),
                    'province_id'     => rand(2, 35),
                    'location_detail' => str_random(100),
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
        Schema::drop('i_' . $this->ins_name);
    }
}
