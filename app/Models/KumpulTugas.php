<?php

namespace App\Models;

use App\User;
use App\Models\Tugas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KumpulTugas extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    // Relationship

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function nilais()
    {
        return $this->tugas()->morphMany(Nilai::class, 'nilaiable');
    }
}
