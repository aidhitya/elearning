<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Kelas;

class Murid extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = ['user_id'];

    public function getRouteKeyName()
    {
        return 'nis';
    }

    // Relathionship

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
