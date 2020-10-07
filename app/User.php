<?php

namespace App;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];

    // Relathionship

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function murid()
    {
        return $this->hasOne(Murid::class, 'user_id', 'id');
    }

    public function mengajar()
    {
        return $this->hasMany(Mapel::class, 'guru_id', 'id');
    }

    // Wali Kelas => Guru
    public function wali_kelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id', 'id');
    }
}
