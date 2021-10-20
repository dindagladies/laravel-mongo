<?php

namespace App\Repositories;

use App\Models\Mobil;
use App\Models\TransaksiMobil;

class MobilRepository
{
    protected $model = null;

    public function __construct(Mobil $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($request)
    {
        // validate 
        
        $data = [
            'nama' => $request->nama,
            'mesin' => $request->mesin,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'tipe' => $request->tipe,
            'stock' => $request->stock,
            'id_kendaraan' => $request->id_kendaraan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->model->create($data);
    }
}