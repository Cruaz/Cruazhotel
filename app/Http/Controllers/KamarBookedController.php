<?php

namespace App\Http\Controllers;

use App\Models\kamar_booked;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KamarBookedController extends Controller
{
    public function index()
    {
        $KamarBooked = kamar_booked::inRandomOrder()->get();

        return response([
            'message' => 'All KamarBooked Retrieved',
            'data' => $KamarBooked
        ], 200);
    }
    public function getData(){
        $data = kamar_booked::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showKamarBookedbyUser($id) {
        $user = User::find($id);
        if(!$user){
            return response([
                'message' => 'User Not Found',
                'data' => null
            ],404);
        }
        $KamarBooked = kamar_booked::where('id_user', $user->id)->get();
        return response([
            'message' => 'KamarBooked of '.$user->name.' Retrieved',
            'data' => $KamarBooked
        ],200);

    }


    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData,[
            'id_bookings' => 'required',
            'id_kamars' => 'required',
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
        $lastId = kamar_booked::latest('id_kamar_booked')->first();
        $newId = $lastId ? 'KB' . str_pad((int) substr($lastId->id_kamar_booked, 1) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';
        $storeData['id_kamar_booked'] = $newId;
        $KamarBooked = kamar_booked::create($storeData);
        return response([
            'message' => 'KamarBooked Added Successfully',
            'data' => $KamarBooked,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $KamarBooked = kamar_booked::find($id);

        if($KamarBooked){
            return response([
                'message' => 'KamarBooked Found',
                'data' => $KamarBooked
            ],200);
        }

        return response([
            'message' => 'KamarBooked Not Found',
            'data' => null
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $KamarBooked = kamar_booked::find($id);
        if(is_null($KamarBooked)){
            return response([
                'message' => 'KamarBooked Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData,[
            'id_bookings' => 'required',
            'id_kamars' => 'required',
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


        $KamarBooked->update($updateData);

        return response([
            'message' => 'KamarBooked Updated Successfully',
            'data' => $KamarBooked,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $KamarBooked = kamar_booked::find($id);

        if(is_null($KamarBooked)){
            return response([
                'message' => 'KamarBooked Not Found',
                'data' => null
            ],404);
        }

        if($KamarBooked->delete()){
            return response([
                'message' => 'KamarBooked Deleted Successfully',
                'data' => $KamarBooked,
            ],200);
        }

        return response([
            'message' => 'Delete KamarBooked Failed',
            'data' => null,
        ],400);
    }
}
