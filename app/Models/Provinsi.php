<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';
    protected $primaryKey = 'id_provinsi';
    public $timestamps = true;

    protected $fillable = [
        'kode_provinsi',
        'nama_provinsi',
    ];

    public function kabupatens(): HasMany
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi', 'id_provinsi');
    }
}
