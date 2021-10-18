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
        return $this->model;
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    // public function kurangi_stock($id_motor)
    // {
    //     $data = $this->model->where('id', $id)->first();
    //     $data->stock = int ($data->stock) - 1;
    //     $data->save();
    // }

}