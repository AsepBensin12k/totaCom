<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamats';
    protected $primaryKey = 'id_alamat';

    protected $fillable = [
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'detail_alamat'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function akuns()
    {
        return $this->hasMany(Akun::class, 'id_alamat', 'id_alamat');
    }
}
