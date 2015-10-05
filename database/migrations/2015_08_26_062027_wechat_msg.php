<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WechatMsg extends Migration
{
    public $ins_name = 'wechat_msg';
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
            $t->string('title');
            $t->text('content')->nullable();
            $t->text('img_url')->nullable();
            $t->softDeletes();
            $t->timestamps();
        });

        //$count = 1000;
        //
        //for ($i = 0; $i < $count; $i++)
        //{
        //    db_c($this->ins_name, 'i',
        //        [
        //            'at'             => date("Y-m-d H:i:s", mt_rand(1161302400, 1440560208)),
        //            'action_type_id' => rand(1, 10),
        //            'ins_type_id'    => rand(1, 10),
        //            'related_id'     => rand(1, 1000),
        //            'operator_type'  => rand(1, 5),
        //            'memo'           => str_random(500),
        //        ]
        //    );
        //}
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
