<?php

namespace App\Http\Controllers;

use App\Models\galery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GaleryController extends Controller
{
    public function index(Request $request)
    {
        $query = galery::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('id_image', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $Galery = $query->paginate($perPage);

        return response([
            'message' => 'All Galery Retrieved',
            'data' => $Galery
        ], 200);
    }
    public function getData()
    {
        $data = galery::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showGalerybyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $Galery = galery::where('id_user', $user->id)->get();
        return response([
            'message' => 'Galery of ' . $user->name . ' Retrieved',
            'data' => $Galery
        ], 200);
    }


    public function store(Request $request)
    {
        $storeData = [];
        if ($request->has('id_jenises') && $request->id_jenises != '') {
            $storeData['id_jenises'] = $request->id_jenises;
        }
        if ($request->has('id_services') && $request->id_services != '') {
            $storeData['id_services'] = $request->id_services;
        }


        $validate = Validator::make($storeData, [
            'id_jenises' => 'nullable',
            'id_services' => 'nullable',
            // 'foto' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found'
            ], 404);
        }
        if ($user->role == 0) {
            return response([
                'message' => 'User Cannot'
            ], 404);
        }
        $lastId = galery::latest('id_image')->first();
        $newId = $lastId ? 'G' . str_pad((int) substr($lastId->id_image, 1) + 1, 3, '0', STR_PAD_LEFT) : 'G001';
        $storeData['id_image'] = $newId;

        $uploadFolder = 'Galery';
        $image = $request->file('foto');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = basename($image_uploaded_path);

        $storeData['foto'] = $uploadedImageResponse;

        $Galery = galery::create($storeData);
        return response([
            'message' => 'Galery Added Successfully',
            'data' => $Galery,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Galery = galery::find($id);

        if ($Galery) {
            return response([
                'message' => 'Galery Found',
                'data' => $Galery
            ], 200);
        }

        return response([
            'message' => 'Galery Not Found',
            'data' => null
        ], 404);
    }
    public function showServiceOrRoom($id)
    {
        $Galery = Galery::where('id_services', 'like', '%' . $id . '%')
            ->orWhere('id_jenises', 'like', '%' . $id . '%')
            ->get();

        if ($Galery) {
            return response([
                'message' => 'Galery Found',
                'data' => $Galery
            ], 200);
        }

        return response([
            'message' => 'Galery Not Found',
            'data' => null
        ], 404);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Galery = galery::find($id);
        if (is_null($Galery)) {
            return response([
                'message' => 'Galery Not Found',
                'data' => null
            ], 404);
        }

        $updateData = [];
        if ($request->has('id_jenises') && $request->id_jenises != '') {
            $updateData['id_jenises'] = $request->id_jenises;
        }
        if ($request->has('id_services') && $request->id_services != '') {
            $updateData['id_services'] = $request->id_services;
        }

        $validate = Validator::make($updateData, [
            'id_jenises' => 'nullable',
            'id_services' => 'nullable',
            // 'foto' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found'
            ], 404);
        }
        if ($user->role == 0) {
            return response([
                'message' => 'User Cannot'
            ], 404);
        }
        if ($request->hasFile('foto')) {

            $uploadFolder = 'Galery';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $uploadedImageResponse = basename($image_uploaded_path);
            Storage::disk('public')->delete('Galery/' . $Galery->foto);
            $updateData['foto'] = $uploadedImageResponse;
        }

        $Galery->update($updateData);

        return response([
            'message' => 'Galery Updated Successfully',
            'data' => $Galery,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Galery = galery::find($id);
        Storage::disk('public')->delete('Galery/' . $Galery->foto);
        if (is_null($Galery)) {
            return response([
                'message' => 'Galery Not Found',
                'data' => null
            ], 404);
        }

        if ($Galery->delete()) {
            return response([
                'message' => 'Galery Deleted Successfully',
                'data' => $Galery,
            ], 200);
        }

        return response([
            'message' => 'Delete Galery Failed',
            'data' => null,
        ], 400);
    }
}
