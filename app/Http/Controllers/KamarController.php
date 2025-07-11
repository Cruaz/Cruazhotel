<?php

namespace App\Http\Controllers;

use App\Models\kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    public function index(Request $request)
    {   
        $query = kamar::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('id_jenises', 'like', '%' . $request->search . '%') 
                  ->orWhere('status', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $Kamar = $query->paginate($perPage);

        return response([
            'message' => 'All Kamar Retrieved',
            'data' => $Kamar
        ], 200);
    }
    public function getData(){
        $data = kamar::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showKamarbyUser($id) {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        $Kamar = kamar::where('id_user', $user->id)->get();
        return response([
            'message' => 'Kamar of '.$user->name.' Retrieved',
            'data' => $Kamar
        ],200);

    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData,[
            'id_jenises' => 'required',
            'lantai' => 'required',
            'Status' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message'=> $validate->errors()],400);
        }
        $lastId = kamar::latest('id_kamar')->first();
        $storeData['id_kamar'] = $lastId->id_kamar+1;

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

        $Kamar = kamar::create($storeData);
        return response([
            'message' => 'Kamar Added Successfully',
            'data' => $Kamar,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Kamar = kamar::find($id);

        if($Kamar){
            return response([
                'message' => 'Kamar Found',
                'data' => $Kamar
            ],200);
        }

        return response([
            'message' => 'Kamar Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $Kamar = kamar::find($id);
        if(is_null($Kamar)){
            return response([
                'message' => 'Kamar Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        
        $validate = Validator::make($updateData,[
            'id_jenises' => 'required',
            'lantai' => 'required',
            'Status' => 'required',
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

        $Kamar->update($updateData);
        return response([
            'message' => 'Kamar Updated Successfully',
            'data' => $Kamar,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Kamar = kamar::find($id);

        if(is_null($Kamar)){
            return response([
                'message' => 'Kamar Not Found',
                'data' => null
            ],404);
        }

        if($Kamar->delete()){
            return response([
                'message' => 'Kamar Deleted Successfully',
                'data' => $Kamar,
            ],200);
        }

        return response([
            'message' => 'Delete Kamar Failed',
            'data' => null,
        ],400);
    }
}
