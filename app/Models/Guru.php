<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function getRouteKeyName()
    {
        return 'nip';
    }

    // Relathionship

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
