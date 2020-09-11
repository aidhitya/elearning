<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $guarded = [];

    // Relathionship

    public function speckelas() // specicific kelas
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
