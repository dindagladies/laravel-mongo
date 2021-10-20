<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $collection = 'mobils';
    protected $table = 'mobils';
    protected $id = 'id';
    protected $fillable = [
        'id',
        'nama',
        'mesin',
        'kapasitas_penumpang',
        'tipe',
        'stock',
        'id_kendaraan'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
