<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailSoal;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jawaban extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function detail_soal()
    {
        return $this->belongsTo(DetailSoal::class);
    }
}
