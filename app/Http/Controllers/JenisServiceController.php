<?php

namespace App\Http\Controllers;

use App\Models\jenis_service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JenisServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = jenis_service::query(); 
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $JenisService = $query->paginate($perPage);

        return response([
            'message' => 'All JenisService Retrieved',
            'data' => $JenisService
        ], 200);
    }
    public function getData(){
        $data = jenis_service::with('galery')->get();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showJenisServicebyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $JenisService = jenis_service::where('id_user', $user->id)->get();
        return response([
            'message' => 'JenisService of ' . $user->name . ' Retrieved',
            'data' => $JenisService
        ], 200);
    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'harga' => 'required',
            'namaIcon' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'ServiceOverview' => 'required',
            'deskripsi' => 'required',
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
        $lastId = jenis_service::latest('id_service')->first();
        $newId = $lastId ? 'JS' . str_pad((int) substr($lastId->id_service, 2) + 1, 3, '0', STR_PAD_LEFT) : 'JS001';
        $storeData['id_service'] = $newId;
        $JenisService = jenis_service::create($storeData);
        return response([
            'message' => 'JenisService Added Successfully',
            'data' => $JenisService,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $JenisService = jenis_service::with('galery')->find($id);

        if ($JenisService) {
            return response([
                'message' => 'JenisService Found',
                'data' => $JenisService
            ], 200);
        }

        return response([
            'message' => 'JenisService Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $JenisService = jenis_service::find($id);
        if (is_null($JenisService)) {
            return response([
                'message' => 'JenisService Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'harga' => 'required',
            'namaIcon' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'ServiceOverview' => 'required',
            'deskripsi' => 'required',
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
        $JenisService->update($updateData);

        return response([
            'message' => 'JenisService Updated Successfully',
            'data' => $JenisService,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $JenisService = jenis_service::find($id);

        if (is_null($JenisService)) {
            return response([
                'message' => 'JenisService Not Found',
                'data' => null
            ], 404);
        }

        if ($JenisService->delete()) {
            return response([
                'message' => 'JenisService Deleted Successfully',
                'data' => $JenisService,
            ], 200);
        }

        return response([
            'message' => 'Delete JenisService Failed',
            'data' => null,
        ], 400);
    }
}
