<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IMessage extends BaseModel
{
    protected $guarded = ['id'];

    protected $ins_name = 'privatemessage';

    public $timestamps = false;

}
