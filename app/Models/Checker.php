<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Nilai;
use App\Models\DetailSoal;
use App\Models\Jawaban;

class Checker extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }

    public function detail_soal()
    {
        return $this->belongsTo(DetailSoal::class);
    }

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class);
    }

}
