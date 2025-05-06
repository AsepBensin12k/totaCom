<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    public $timestamps = false;

    protected $fillable = [
        'role',
    ];

    // Relasi dengan Akun
    public function akuns()
    {
        return $this->hasMany(Akun::class, 'id_role', 'id_role');
    }
}
