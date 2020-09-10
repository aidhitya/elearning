<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $guarded = [];

    // Relathionship

    public function parentKelas() // untuk group kelas
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }

    public function kelas() // untuk specific kelas
    {
        return $this->belongsTo(Kelas::class);
    }
}
