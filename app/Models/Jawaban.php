<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailSoal;

class Jawaban extends Model
{
    protected $guarded = [];

    public function detail_soal()
    {
        return $this->belongsTo(DetailSoal::class);
    }
}
