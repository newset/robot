<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Department extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $ins_name = 'department';

    public function up()
    {
        Schema::create('i_' . $this->ins_name, function (Blueprint $t)
        {
            $t->engine = 'InnoDB';
            $t->increments('id');
            $t->string('name');
            $t->string('username')->unique();
            $t->string('password');
            $t->integer('hospital_id')->unsigned();
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();

            $t->foreign('hospital_id')->references('id')->on('i_hospital')->onDelete('cascade');
        });


        $count = 400;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'name'        => str_random(2) . $i . '科',
                    'username'    => 'department' . $i,
                    'password'    => hash_password('department' . $i),
                    'hospital_id' => rand(1, 400),
                    'memo'        => str_random(200),
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
