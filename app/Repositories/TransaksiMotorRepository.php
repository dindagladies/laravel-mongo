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
        return $this->model->all();
    }

    public function findByIdLaporan($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function sell($request)
    {
        $data = [
            'id_motor' => $request->id_motor,
            'tanggal' => $request->tanggal,
            'harga_jual' => $request->harga_jual
        ];

        return $this->model->create($data);

        // pengurangan stock
        $this->kurangi_stock($request->id_motor);
    }

    public function kurangi_stock($id)
    {
        // get stock
        $stock = Motor::select('stock')->where('id', $id)->first();
        // update
        $data = Motor::where('id', $id)->first();
        $data->stock = int ($stock - 1);
        $data->save();
    }
}