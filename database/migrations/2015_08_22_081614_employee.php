<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\IEmployee;

class Employee extends Migration
{
    public $ins_name = 'employee';

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
            $t->string('name');
            $t->string('username')->unique();
            $t->string('password');
            $t->string('phone')->nullable();
            $t->string('email')->nullable();
            $t->smallInteger('status')->default(1);
            $t->text('memo')->nullable();
            $t->softDeletes();
            $t->timestamps();
        });

        db_c($this->ins_name, 'i',
            [
                'name'            => str_random(2) . ' ' . str_random(2),
                'username'        => 'admin',
                'password'        => hash_password('admin'),
                'phone'           => rand(13000000000, 13999999999),
                'email'           => str_random(3) . '@' . str_random(3) . '.com',
                'memo'            => str_random(200),
            ]);

        $count = 100;

        for ($i = 0; $i < $count; $i++)
        {
            db_c($this->ins_name, 'i',
                [
                    'name'            => str_random(2) . ' ' . str_random(2),
                    'username'        => $this->ins_name . $i,
                    'password'        => hash_password($this->ins_name . $i),
                    'phone'           => rand(13000000000, 13999999999),
                    'email'           => str_random(3) . '@' . str_random(3) . '.com',
                    'memo'            => str_random(200),
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
