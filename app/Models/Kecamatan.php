<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kecamatan';
    public $incrementing = true;
    public $keyType = 'int';

    protected $fillable = [
        'kode_kecamatan',
        'nama_kecamatan',
        'id_kabupaten',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten', 'id_kabupaten');
    }
}
