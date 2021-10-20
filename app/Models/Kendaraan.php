<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    // protected $connection = 'mongodb';
    protected $table = 'kendaraans';
    protected $fillable = [
        'id', 'tahun_keluaran', 'warna', 'harga'
    ];

    public function motor()
    {
        return $this->hasOne(Motor::class);
    }

    public function mobil()
    {
        return $this->hasOne(Mobil::class);
    }
}
