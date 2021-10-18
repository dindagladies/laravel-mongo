<?php

namespace App\Repositories;

use App\Models\Motor;
use App\Models\TransaksiMotor;

class TransaksiMotorRepository
{
    protected $model = null;

    public function __construct(TransaksiMotor $model)
    {
        $this->model = $model;
    }

    
    public function getAllPenjualan()
    {
        try{
            return $this->model;
        }catch (\Exception $e){
            return [];
        }
    }

    public function findByIdLaporan($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function sell(array $data)
    {
        return $this->model->create($data);

        // pengurangan stock
        // $this->kurangi_stock($data['id_motor']);
    }
}