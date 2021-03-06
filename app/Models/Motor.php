<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;

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
        'tipe_tranmisi',
        'stock',
        'id_kendaraan'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
