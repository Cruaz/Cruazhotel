<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $query = Fasilitas::query(); 
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $Fasilitas = $query->paginate($perPage);

        return response([
            'message' => 'All Fasi$Fasilitas Retrieved',
            'data' => $Fasilitas
        ], 200);
    }
    public function getData(){
        $data = Fasilitas::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showFasilitasbyUser($id) {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        $Fasilitas = fasilitas::where('id_user', $user->id)->get();
        return response([
            'message' => 'Fasi$Fasilitas of '.$user->name.' Retrieved',
            'data' => $Fasilitas
        ],200);

    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData,[
            'deskripsi' => 'required',
            'nama' => 'required',
            'namaIcon' => 'required',
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
        $lastId = fasilitas::latest('id_fasilitas')->first();
        $newId = $lastId ? 'F' . str_pad((int) substr($lastId->id_fasilitas, 1) + 1, 3, '0', STR_PAD_LEFT) : 'F001';
        $storeData['id_fasilitas'] = $newId;

        $Fasilitas = fasilitas::create($storeData);
        return response([
            'message' => 'Fasilitas Added Successfully',
            'data' => $Fasilitas,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Fasilitas = fasilitas::find($id);

        if($Fasilitas){
            return response([
                'message' => 'Fasilitas Found',
                'data' => $Fasilitas
            ],200);
        }

        return response([
            'message' => 'Fasilitas Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Fasilitas = fasilitas::find($id);
        if(is_null($Fasilitas)){
            return response([
                'message' => 'Fasilitas Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData,[
            'deskripsi' => 'required',
            'nama' => 'required',
            'namaIcon' => 'required',
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

        $Fasilitas->update($updateData);

        return response([
            'message' => 'Fasilitas Updated Successfully',
            'data' => $Fasilitas,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Fasilitas = fasilitas::find($id);

        if(is_null($Fasilitas)){
            return response([
                'message' => 'Fasilitas Not Found',
                'data' => null
            ],404);
        }

        if($Fasilitas->delete()){
            return response([
                'message' => 'Fasilitas Deleted Successfully',
                'data' => $Fasilitas,
            ],200);
        }

        return response([
            'message' => 'Delete Fasilitas Failed',
            'data' => null,
        ],400);
    }
}
