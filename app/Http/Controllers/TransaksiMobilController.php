<?php

namespace App\Http\Controllers;

use App\Repositories\TransaksiMobilRepository AS Repo;
use App\Models\TransaksiMobil;
use Illuminate\Http\Request;

class TransaksiMobilController extends Controller
{
    // Penjualan mobil
    public function penjualan(Repo $repo, Request $request)
    {
        if($repo->sell($request)){
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

    public function detail_laporan(Repo $repo, $id)
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
