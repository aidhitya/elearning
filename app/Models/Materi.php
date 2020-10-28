<?php

namespace App\Models;

use App\User;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\PertemuanScope;

class Materi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new PertemuanScope);
    }

    // Relathionship

    public function parentKelas() // untuk group kelas
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }

    public function kelas_spec() // untuk specific kelas
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    // Attributes
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords($value);
    }
}
