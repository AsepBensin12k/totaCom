<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kabupaten';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'kode_kabupaten',
        'nama_kabupaten',
        'id_provinsi',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten');
    }
}
