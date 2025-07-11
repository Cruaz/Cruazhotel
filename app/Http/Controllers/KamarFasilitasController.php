<?php

namespace App\Http\Controllers;

use App\Models\kamar_fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KamarFasilitasController extends Controller
{
    public function index()
    {
        $KamarFasilitas = kamar_fasilitas::inRandomOrder()->get();

        return response([
            'message' => 'All KamarFasilitas Retrieved',
            'data' => $KamarFasilitas
        ], 200);
    }
    public function getData(){
        $data = kamar_fasilitas::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showKamarFasilitasbyUser($id) {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        $KamarFasilitas = kamar_fasilitas::where('id_user', $user->id)->get();
        return response([
            'message' => 'KamarFasilitas of '.$user->name.' Retrieved',
            'data' => $KamarFasilitas
        ],200);

    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData,[
            'id_jeniss' => 'required',
            'id_fasilitass' => 'required',
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
        if($user->role==0){
            return response([
                'message' => 'User Cannot'
            ],404);
        }

        $KamarFasilitas = kamar_fasilitas::create($storeData);
        return response([
            'message' => 'KamarFasilitas Added Successfully',
            'data' => $KamarFasilitas,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $KamarFasilitas = kamar_fasilitas::find($id);

        if($KamarFasilitas){
            return response([
                'message' => 'KamarFasilitas Found',
                'data' => $KamarFasilitas
            ],200);
        }

        return response([
            'message' => 'KamarFasilitas Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $KamarFasilitas = kamar_fasilitas::find($id);
        if(is_null($KamarFasilitas)){
            return response([
                'message' => 'KamarFasilitas Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'id_jeniss' => 'required',
            'id_fasilitass' => 'required',
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
        if($user->role==0){
            return response([
                'message' => 'User Cannot'
            ],404);
        }

        $KamarFasilitas->update($updateData);

        return response([
            'message' => 'KamarFasilitas Updated Successfully',
            'data' => $KamarFasilitas,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $KamarFasilitas = kamar_fasilitas::find($id);

        if(is_null($KamarFasilitas)){
            return response([
                'message' => 'KamarFasilitas Not Found',
                'data' => null
            ],404);
        }

        if($KamarFasilitas->delete()){
            return response([
                'message' => 'KamarFasilitas Deleted Successfully',
                'data' => $KamarFasilitas,
            ],200);
        }

        return response([
            'message' => 'Delete KamarFasilitas Failed',
            'data' => null,
        ],400);
    }
}
