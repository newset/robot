<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Doctor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $ins_name = 'doctor';

    public function up()
    {
        Schema::create('i_' . $this->ins_name, function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->string('name');
            $t->unsignedInteger('hospital_id');
            $t->unsignedInteger('department_id');
            $t->integer('cust_id')->unsigned()->unique();
            $t->string('title');
            $t->integer('level');
            $t->text('memo')->nullable();
            $t->string('wechat_id')->nullable();
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->smallInteger('gender')->nullable()->default(1);
            $t->smallInteger('status')->default(1);
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('hospital_id')->references('id')->on('i_hospital')->onDelete('cascade');
            $t->foreign('department_id')->references('id')->on('i_department')->onDelete('cascade');
        });

        $count = 1000;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'name'          => str_random(2) . ' ' . str_random(2),
                    'department_id' => rand(1, 400),
                    'hospital_id'   => rand(1, 400),
                    'cust_id'       => 1000000 + $i,
                    'title'         => str_random(10),
                    'level'         => rand(1, 5),
                    'phone'         => rand(13000000000, 13999999999),
                    'email'         => str_random(3) . '@' . str_random(2) . '.com',
                    'status'         => rand(1, 3),
                    'memo'          => str_random(200),
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
