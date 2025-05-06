<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_transaksies';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_detail',
    ];

    // Relasi dengan DetailPesanan
    public function detailPesanan()
    {
        return $this->belongsTo(DetailPesanan::class, 'id_detail', 'id_detail');
    }
}
