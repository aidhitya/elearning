<?php

namespace App\Models;

use App\User;
use App\Models\KumpulTugas;
use App\Scopes\SelesaiScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tugas extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope(new SelesaiScope);
    }

    // Relationship

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kumpultugas()
    {
        return $this->hasMany(KumpulTugas::class);
    }

    // Attributes
    public function setJudulTugasAttribute($value)
    {
        $this->attributes['judul_tugas'] = ucwords($value);
    }
}
