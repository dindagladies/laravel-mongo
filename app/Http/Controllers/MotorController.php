<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Repositories\MotorRepository AS Repo;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

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

    // Create stock motor
    public function create(Repo $repo, Request $request)
    {
        $data = $repo->create($request);
        if($data){
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Motor created successfully',
                'data' => $data
            ], Response::HTTP_OK);

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
