<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agency extends Migration
{
    public $ins_name = 'agency';

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
            $t->text('name');
            $t->text('name_in_charge');
            $t->integer('city_id')->unsigned();
            $t->integer('province_id')->unsigned();
            $t->text('location_detail');
            $t->string('username')->unique();
            $t->string('password');
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->date('started_at')->nullable();
            $t->date('ended_at')->nullable();
            $t->smallInteger('status')->default(1); // 0为冻结账户
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();
        });

        $count = 1000;

        db_c($this->ins_name, 'i',
            [
                'id' => 1,
                'name' => '自营',
                'name_in_charge' => str_random(2) . ' ' . str_random(2),
                'location_detail' => str_random(100),
                'started_at' => date("Y-m-d H:i:s",  1440560208),
                'ended_at' => date("Y-m-d H:i:s", 1840560208),
                'city_id' => rand(36, 398),
                'province_id' => rand(2, 35),
                'username' => $this->ins_name . 'self',
                'password' => hash_password($this->ins_name . 'self'),
                'phone' => rand(13000000000, 13999999999),
                'email' => str_random(3) . '@' . str_random(3) . '.com',
                'memo' => str_random(200),
                'status' => rand(0, 1),
            ]);

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'name' => str_random(2) . '集团',
                    'name_in_charge' => str_random(2) . ' ' . str_random(2),
                    'location_detail' => str_random(100),
                    'started_at' => date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208)),
                    'ended_at' => date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208) + rand(1000000, 999999999)),
                    'city_id' => rand(36, 398),
                    'province_id' => rand(2, 35),
                    'username' => $this->ins_name . $i,
                    'password' => hash_password($this->ins_name . $i),
                    'phone' => rand(13000000000, 13999999999),
                    'email' => str_random(3) . '@' . str_random(3) . '.com',
                    'memo' => str_random(200),
                    'status' => rand(0, 1),
                ]);
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
