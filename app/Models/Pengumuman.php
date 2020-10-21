<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman', $guarded = [];

    // Relationship

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_pengumuman');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
