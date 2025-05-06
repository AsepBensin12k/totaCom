<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    protected $fillable = [
        'status',
    ];

    // Relasi dengan Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_status', 'id_status');
    }
}
