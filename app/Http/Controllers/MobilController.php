<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\MobilRepository AS Repo;

class MobilController extends Controller
{
    // List Mobil
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

    // Create stock mobil
    public function create(Repo $repo, Request $request)
    {
        $data = $repo->create($request);
        if($data){
            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Mobil created successfully',
                'data' => $data
            ], Response::HTTP_OK);

        }else{
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    // Detail mobil
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
