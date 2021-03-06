<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMotor extends Model
{
    use HasFactory;
    protected $collection = 'transaksi_motors';
    protected $table = 'transaksi_motors';
    protected $id = 'id';
    protected $fillable = [
        'id_motor',
        'tanggal',
        'harga_jual'
    ];

}
