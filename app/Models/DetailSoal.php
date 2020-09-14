<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soal;

class DetailSoal extends Model
{
    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
