<?php

namespace App\Http\Controllers;

use App\Models\service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        $Service = service::inRandomOrder()->get();

        return response([
            'message' => 'All Service Retrieved',
            'data' => $Service
        ], 200);
    }
    public function getData(){
        $data = service::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showServicebyUser($id) {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        $Service = service::where('id_user', $user->id)->get();
        return response([
            'message' => 'Service of '.$user->name.' Retrieved',
            'data' => $Service
        ],200);

    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData,[
            'id_pemesanan' => 'required',
            'id_service' => 'required',
            'Time-Jumlah' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message'=> $validate->errors()],400);
        }

        $idUser = Auth::id();
        $user = User::find($idUser);
        if(is_null($user)){
            return response([
                'message' => 'User Not Found'
            ],404);
        }


        $Service = service::create($storeData);
        return response([
            'message' => 'Service Added Successfully',
            'data' => $Service,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Service = service::find($id);

        if($Service){
            return response([
                'message' => 'Service Found',
                'data' => $Service
            ],200);
        }

        return response([
            'message' => 'Service Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Service = service::find($id);
        if(is_null($Service)){
            return response([
                'message' => 'Service Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData,[
            'id_pemesanan' => 'required',
            'id_service' => 'required',
            'Time-Jumlah' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message'=> $validate->errors()],400);
        }
        $idUser = Auth::id();
        $user = User::find($idUser);
        if(is_null($user)){
            return response([
                'message' => 'User Not Found'
            ],404);
        }
        
        $Service->update($updateData);

        return response([
            'message' => 'Service Updated Successfully',
            'data' => $Service,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Service = service::find($id);

        if(is_null($Service)){
            return response([
                'message' => 'Service Not Found',
                'data' => null
            ],404);
        }

        if($Service->delete()){
            return response([
                'message' => 'Service Deleted Successfully',
                'data' => $Service,
            ],200);
        }

        return response([
            'message' => 'Delete Service Failed',
            'data' => null,
        ],400);
    }
}
