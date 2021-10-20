<?php

namespace App\Repositories;

use App\Models\Mobil;
use App\Models\TransaksiMobil;

class TransaksiMobilRepository
{
    protected $model = null;

    public function __construct(TransaksiMobil $model)
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
            'id_mobil' => $request->id_mobil,
            'tanggal' => $request->tanggal,
            'harga_jual' => $request->harga_jual
        ];

        return $this->model->create($data);

        // pengurangan stock
        $this->kurangi_stock($request->id_mobil);
    }

    public function kurangi_stock($id)
    {
        // get stock
        $stock = Mobil::select('stock')->where('id', $id)->first();
        // update
        $data = Mobil::where('id', $id)->first();
        $data->stock = int ($stock - 1);
        $data->save();
    }
}