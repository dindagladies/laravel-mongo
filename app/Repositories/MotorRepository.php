<?php

namespace App\Repositories;

use App\Models\Motor;
use App\Models\TransaksiMotor;

class MotorRepository
{
    protected $model = null;

    public function __construct(Motor $model)
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
            'tipe_suspensi' => $request->tipe_suspensi,
            'tipe_tranmisi' => $request->tipe_tranmisi,
            'stock' => $request->stock,
            'id_kendaraan' => $request->id_kendaraan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->model->create($data);
    }

}