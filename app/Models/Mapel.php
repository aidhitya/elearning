<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Relathionship

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }

    public function materis() // mapel child
    {
        return $this->hasMany(Materi::class, 'mapel_id', 'parent_id');
    }

    public function materi() // mapel parent
    {
        return $this->hasMany(Materi::class);
    }

    // Mapel Parent

    public function parent()
    {
        return $this->belongsTo(Mapel::class, 'parent_id');
    }


    // Mapel Child

    public function child()
    {
        return $this->hasMany(Mapel::class, 'parent_id');
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

    // Mutators

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords($value);
    }
}
