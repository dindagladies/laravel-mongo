<?php

namespace App\Http\Controllers;

use App\Repositories\MotorRepository AS Repo;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    // List motor
    public function index(Repo $repo)
    {
        $data = $repo->getAll();
        if($data){
            return response($data, 200);
        }else{
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    // Detail motor
    public function detail(Repo $repo, $id)
    {
        $data = $repo->findById($id);
        if($data){
            return response($data, 200);
        }else{
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
}
