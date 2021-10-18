<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;
    protected $table = 'motors';
    protected $id = 'id';
    protected $fillable = [
        'id',
        'nama',
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
        'stock',
        // 'id_kendaraan'
    ];
}
