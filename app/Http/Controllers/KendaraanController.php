<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class KendaraanController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->kendaraans()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data
        $data = $request->only('tahun_keluaran', 'warna', 'harga');
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
        ]);

        // If request is not valid, send failed response
        if($validator->fails()){
            return response()->json(['error' => $validator->message()], 200);
        }

        // Request valid, do store
        $kendaraan = $this->user->kendaraan()->create([
            'tahun_keluaran' => $request->tahun_keluaran,
            'warna' => $request->warna,
            'harga' => $request->harga
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Kendaraan created successfully',
            'data' => $kendaraan
        ], Response::HTTP_OK);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        $kendaraan = $this->user->kendaraan()->find($id);

        if(!$kendaraan){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, kendaraan not found'
            ], 400);
        }

        return $kendaraan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        // Validate data
        $data = $request->only('tahun_keluaran', 'warna', 'harga');
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
        ]);

        // If request is not valid, send failed response
        if($validator->fails()){
            return response()->json(['error' => $validator->message()], 200);
        }

        // Update
        $kendaraan = $kendaraan->update([
            'tahun_keluaran' => $request->tahun_keluaran,
            'warna' => $request->warna,
            'harga' => $request->harga
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Kendaraan updated successfully',
            'data' => $kendaraan
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan deleted successfully'
        ], Response::HTTP_OK);
    }
}
