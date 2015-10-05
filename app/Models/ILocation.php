<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ILocation extends Model
{
    public function province_and_city()
    {
        return ss(locations());
    }
}
