<?php

namespace App\Models;

use App\User;
use App\Models\Materi;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relathionship

    public function wali_kelas()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }

    public function murids()
    {
        return $this->hasMany(Murid::class);
    }

    public function materis() // kelas specific
    {
        return $this->hasMany(Materi::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'kelas', 'kelas')->whereNull('kelas_id');
    }
}
