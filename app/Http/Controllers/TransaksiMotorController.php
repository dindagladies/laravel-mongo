<?php

namespace App\Http\Controllers;

use App\Repositories\TransaksiMotorRepository AS Repo;
use App\Models\TransaksiMotor;
use Illuminate\Http\Request;

class TransaksiMotorController extends Controller
{
    // Penjualan motor
    public function penjualan(Repo $repo, Request $request)
    {
        $data = [
            'id_motor' => $request->id_kendaraan,
            'tanggal' => $request->tanggal,
            'harga_jual' => $request->harga_jual
        ];

        if($repo->sell($data)){
            return response()->json([
                "message" => "Penjualan berhasil!",
            ], 201);
        }else{
            return response()->json([
                "message" => "Gagal melakukan transaksi !"
            ], 404);
        }
    }

    public function laporan_penjualan(Repo $repo)
    {
        $data = $repo->getAllPenjualan();
        if($data){
            return response($data, 200);
        }else{
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function detail_laporan(Repo $repo)
    {
        $data = $repo->findByIdLaporan($id);
        if($data){
            return response($data, 200);
        }else{
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
}
