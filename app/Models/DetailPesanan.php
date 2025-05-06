<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanans';
    protected $primaryKey = 'id_detail';
    public $timestamps = true;

    protected $fillable = [
        'id_pesanan',
    ];

    // Relasi ke model Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi ke model RiwayatTransaksi
    public function riwayatTransaksi()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_detail', 'id_detail');
    }
}
