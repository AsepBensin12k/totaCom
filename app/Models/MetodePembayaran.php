<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $primaryKey = 'id_metode';
    public $timestamps = true;

    protected $fillable = [
        'nama_metode',
    ];

    // Relasi dengan Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_metode', 'id_metode');
    }
}
