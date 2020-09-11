<?php

namespace App\Models;

use App\User;
use App\Models\Materi;
use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];

    // Relathionship

    public function wali_kelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas', 'id');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }
}
