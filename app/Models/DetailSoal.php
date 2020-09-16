<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soal;
use App\Models\Jawaban;

class DetailSoal extends Model
{
    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class, 'detail_soal_id');
    }
}
