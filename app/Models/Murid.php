<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function getRouteKeyName()
    {
        return 'nis';
    }
}
