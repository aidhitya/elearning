<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Soal;
use App\Models\DetailSoal;
use App\Models\Jawaban;

class Checker extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
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
