<?php

namespace App\Http\Controllers;

use App\Models\fasilitas;
use App\Models\jenis_kamar;
use App\Models\kamar_fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JenisKamarController extends Controller
{
    public function index(Request $request)
    {
        $query = jenis_kamar::with('fasilitas');
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $JenisKamar = $query->paginate($perPage);

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $JenisKamar
        ], 200);
    }
    public function getData()
    {
        $data = jenis_kamar::with(['fasilitas', 'galery'])->get();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showJenisKamarbyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $JenisKamar = jenis_kamar::where('id_user', $user->id)->get();
        return response([
            'message' => 'JenisKamar of ' . $user->name . ' Retrieved',
            'data' => $JenisKamar
        ], 200);
    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'harga' => 'required',
            'kapasitas' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'KamarOverview' => 'required',
            'Deskripsi' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $idUser =  Auth::id();
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

        $lastId = jenis_kamar::latest('id_jenis')->first();
        $newId = $lastId ? 'JK' . str_pad((int) substr($lastId->id_jenis, 2) + 1, 3, '0', STR_PAD_LEFT) : 'JK001';
        $storeData['id_jenis'] = $newId;

        $JenisKamar = jenis_kamar::create($storeData);
        $data["id_fasilitass"] = $request["id_fasilitas"];
        $data["id_jeniss"] = $newId;
        kamar_fasilitas::create($data);
        return response([
            'message' => 'JenisKamar Added Successfully',
            'data' => $JenisKamar,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $JenisKamar = jenis_kamar::with(['fasilitas', 'galery'])->find($id);

        if ($JenisKamar) {
            return response([
                'message' => 'JenisKamar Found',
                'data' => $JenisKamar
            ], 200);
        }

        return response([
            'message' => 'JenisKamar Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $JenisKamar = jenis_kamar::find($id);
        if (is_null($JenisKamar)) {
            return response([
                'message' => 'JenisKamar Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'harga' => 'required',
            'kapasitas' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'KamarOverview' => 'required',
            'Deskripsi' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
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
        if ($request->has('id_fasilitas') && $request->id_fasilitas != '') {
            kamar_fasilitas::where('id_jeniss', $id)->delete();
            $data["id_fasilitass"] = $request["id_fasilitas"];
            $data["id_jeniss"] = $id;
            kamar_fasilitas::create($data);
        }

        $JenisKamar->update($updateData);

        return response([
            'message' => 'JenisKamar Updated Successfully',
            'data' => $JenisKamar,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $JenisKamar = jenis_kamar::find($id);

        if (is_null($JenisKamar)) {
            return response([
                'message' => 'JenisKamar Not Found',
                'data' => null
            ], 404);
        }

        if ($JenisKamar->delete()) {
            return response([
                'message' => 'JenisKamar Deleted Successfully',
                'data' => $JenisKamar,
            ], 200);
        }

        return response([
            'message' => 'Delete JenisKamar Failed',
            'data' => null,
        ], 400);
    }
}
