<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Murid extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function getRouteKeyName()
    {
        return 'nis';
    }
}
