<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $guarded = [];

    // Relathionship

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class);
    }

    // Parent

    public function parent()
    {
        return $this->belongsTo(Mapel::class);
    }

    // Scopre Query

    public function scopeGetParent($query)
    {
        $query->whereNull('parent_id');
    }

    public function scopeGetChildren($query)
    {
        $query->whereNotNull('parent_id');
    }
}
