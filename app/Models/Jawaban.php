<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailSoal;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jawaban extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function detail_soal()
    {
        return $this->belongsTo(DetailSoal::class);
    }
}
