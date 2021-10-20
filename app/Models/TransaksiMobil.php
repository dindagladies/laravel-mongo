<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMobil extends Model
{
    use HasFactory;

    protected $collection = 'transaksi_mobils';
    protected $table = 'transaksi_mobils';
    protected $id = 'id';
    protected $fillable = [
        'id_mobil',
        'tanggal',
        'harga_jual'
    ];
}
