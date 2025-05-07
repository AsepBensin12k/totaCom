<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'akuns';
    protected $primaryKey = 'id_akun';

    protected $fillable = [
        'username',
        'password',
        'nama',
        'email',
        'no_hp',
        'id_role',
        'id_alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_akun', 'id_akun');
    }
}
