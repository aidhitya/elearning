<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use App\Models\Materi;
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

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    // Mapel Parent

    public function parent()
    {
        return $this->belongsTo(Mapel::class, 'parent_id');
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
