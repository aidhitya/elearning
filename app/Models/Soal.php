<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\DetailSoal;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soal extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relathionship

    public function speckelas() // specicific kelas
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function detail_soal()
    {
        return $this->hasMany(DetailSoal::class);
    }

    public function nilai()
    {
        return $this->morphMany(Nilai::class, 'nilaiable');
    }
}
