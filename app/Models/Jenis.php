<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'jenises';
    protected $primaryKey = 'id_jenis';
    public $timestamps = false;

    protected $fillable = [
        'nama_jenis',
    ];

    // Relasi dengan Keranjang
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'id_jenis', 'id_jenis');
    }
}
