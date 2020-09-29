<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relationship

    public function murid()
    {
        return $this->belongsTo(User::class);
    }

    public function checker()
    {
        return $this->hasOne(Checker::class);
    }

    public function nilaiable()
    {
        return $this->morphTo();
    }
}
