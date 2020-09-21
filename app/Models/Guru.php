<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

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
