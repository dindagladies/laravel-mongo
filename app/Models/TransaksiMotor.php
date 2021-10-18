<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMotor extends Model
{
    use HasFactory;
    protected $table = 'transaksi_motors';
    protected $id = 'id';
    protected $fillable = [
        'id_kendaraan',
        'tanggal',
        'harga_jual'
    ];

}
