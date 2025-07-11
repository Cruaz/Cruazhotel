<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\jenis_service;
use App\Models\pemesanan;
use App\Models\service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $query = pemesanan::with('Service');
        if ($request->has('search') && $request->search != '') {
            $query->where('id_pemesanan', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $Pemesanan = $query->paginate($perPage);


        return response([
            'message' => 'All Pemesanan Retrieved',
            'data' => $Pemesanan
        ], 200);
    }
    public function getData()
    {
        $data = pemesanan::all();

        return response([
            'message' => 'All JenisKamar Retrieved',
            'data' => $data
        ], 200);
    }
    public function getDataByUserId()
    {
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found'
            ], 404);
        }
        $data = pemesanan::where('id_users', $idUser)->get();
        if ($data->isNotEmpty()) {
            return response([
                'message' => 'Data Retrieved Successfully',
                'data' => $data
            ], 200);
        } else {
            return response([
                'message' => 'No Booking Data Found',
                'data' => null
            ], 404);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function showPemesananbyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $Pemesanan = pemesanan::where('id_users', $user->id)->get();
        return response([
            'message' => 'Pemesanan of ' . $user->name . ' Retrieved',
            'data' => $Pemesanan
        ], 200);
    }
    public function countPesanan()
    {
        $count = pemesanan::count();
        return response([
            'message' => 'Count Retrieved Successfully',
            'count' => $count
        ], 200);
    }
    public function countPesananByUser()
    {
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response(['message' => 'User Not Found'], 404);
        }
        $count = pemesanan::where('id_users', $idUser)->count();
        return response([
            'message' => 'Count Retrieved Successfully',
            'count' => $count
        ], 200);
    }
    public function getCombinedData()
    {
        $pesanan = pemesanan::where('Status', "Booked")->get();
        $bookings = booking::where('Status', "Booked")->get();
        $pesanan->each(function ($item) {
            $item->type = 'Pesanan';
        });
        $bookings->each(function ($item) {
            $item->type = 'Booking';
        });
        $combinedData = $pesanan->concat($bookings);
        return response([
            'message' => 'Data Retrieved Successfully',
            'data' => $combinedData->values() 
        ], 200);
    }

    public function getCombinedDataUser()
    {
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response(['message' => 'User Not Found'], 404);
        }
        $pesanan = pemesanan::where('id_users', $idUser)->where('Status', 'Booked')->take(2)->get();
        $bookings = Booking::where('id_users', $idUser)->where('Status', 'Booked')->take(2)->get();
        $pesanan->each(function ($item) {
            $item->type = 'Pesanan';
        });

        $bookings->each(function ($item) {
            $item->type = 'Booking';
        });
        $combinedData = $pesanan->concat($bookings);
        return response([
            'message' => 'Data Retrieved Successfully',
            'data' => $combinedData->values() 
        ], 200);
    }
    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'total_harga' => '',
            'Status' => 'required',
            'Tgl_pemesanan' => 'required',
            'diskon' => '',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $lastId = pemesanan::latest('id_pemesanan')->first();
        $newId = $lastId ? 'P' . str_pad((int) substr($lastId->id_pemesanan, 1) + 1, 3, '0', STR_PAD_LEFT) : 'P001';
        $storeData['id_pemesanan'] = $newId;

        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found'
            ], 404);
        }
        $storeData['id_users'] = $user->id_user;

        $storeData['total_harga'] = 0;
        $p = 0;
        foreach ($request->Data as $item) {
            $Service = jenis_service::find($item['id_services']);
            if (is_null($Service)) {
                return response([
                    'message' => 'Service Not found',
                ], 404);
            }
            $p += (int)$Service->harga;
        }
        $storeData['total_harga'] = $p - ($p * $storeData["diskon"] / 100);

        $Pemesanan = pemesanan::create($storeData);
        foreach ($request->Data as $items) {
            $storeChildData = $items;
            $storeChildData['id_pemesanan'] = $newId;
            $Service = jenis_service::find($item['id_services']);
            if (is_null($Service)) {
                return response([
                    'message' => 'Barber Not found',
                ], 404);
            }
            $validate = Validator::make($storeChildData, [
                'id_pemesanan' => 'required',
                'id_services' => 'required',
                'Time-Jumlah' => 'required',
            ]);
            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }
            service::create($storeChildData);
        }
        return response([
            'message' => 'Pemesanan Added Successfully',
            'data' => $Pemesanan,
        ], 200);
    }

    public function storeDashboard(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'total_harga' => '',
            'Status' => 'required',
            'Tgl_pemesanan' => 'required',
            'diskon' => '',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $lastId = pemesanan::latest('id_pemesanan')->first();
        $newId = $lastId ? 'P' . str_pad((int) substr($lastId->id_pemesanan, 1) + 1, 3, '0', STR_PAD_LEFT) : 'P001';
        $storeData['id_pemesanan'] = $newId;

        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response([
                'message' => 'User Not Found'
            ], 404);
        }

        $storeData['total_harga'] = $storeData['total_harga'] - ($storeData['total_harga'] * $storeData["diskon"] / 100);

        $Pemesanan = pemesanan::create($storeData);

        $storeChildData['id_services'] = $storeData['id_Service'];
        $storeChildData['id_pemesanan'] = $newId;
        $storeChildData['Time-Jumlah'] = 10;
        $Service = jenis_service::find($storeChildData['id_services']);
        if (is_null($Service)) {
            return response([
                'message' => 'Barber Not found',
            ], 404);
        }
        $validate = Validator::make($storeChildData, [
            'id_pemesanan' => 'required',
            'id_services' => 'required',
            'Time-Jumlah' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        service::create($storeChildData);

        return response([
            'message' => 'Pemesanan Added Successfully',
            'data' => $Pemesanan,
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Pemesanan = pemesanan::find($id);

        if ($Pemesanan) {
            return response([
                'message' => 'Pemesanan Found',
                'data' => $Pemesanan
            ], 200);
        }

        return response([
            'message' => 'Pemesanan Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Pemesanan = pemesanan::find($id);
        if (is_null($Pemesanan)) {
            return response([
                'message' => 'Pemesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'total_harga' => '',
            'Status' => 'required',
            'Tgl_pemesanan' => 'required',
            'diskon' => '',
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
        $updateData['total_harga'] = 0;
        $p = 0;
        service::where('id_pemesanan', $id)->delete();
        foreach ($request->Data as $item) {
            $Service = jenis_service::find($item['id_services']);
            if (is_null($Service)) {
                return response([
                    'message' => 'Service Not found',
                ], 404);
            }
            $p += (int)$Service->harga;

            $storeChildData = $item;
            $storeChildData['id_pemesanan'] = $id;
            $Service = jenis_service::find($item['id_services']);
            if (is_null($Service)) {
                return response([
                    'message' => 'Barber Not found',
                ], 404);
            }
            $validate = Validator::make($storeChildData, [
                'id_pemesanan' => 'required',
                'id_services' => 'required',
                'Time-Jumlah' => 'required',
            ]);
            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }
            service::create($storeChildData);
        }
        $updateData['total_harga'] = $p - ($p * $updateData["diskon"] / 100);

        $Pemesanan->update($updateData);

        return response([
            'message' => 'Pemesanan Updated Successfully',
            'data' => $Pemesanan,
        ], 200);
    }


    public function updateDashboard(Request $request, string $id)
    {
        $Pemesanan = pemesanan::find($id);
        if (is_null($Pemesanan)) {
            return response([
                'message' => 'Pemesanan Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'total_harga' => '',
            'Status' => 'required',
            'Tgl_pemesanan' => 'required',
            'diskon' => '',
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
        if ($Pemesanan->total_harga != $updateData['total_harga']) {
            $updateData['total_harga'] = intval($updateData['total_harga'] - ($updateData['total_harga'] * $updateData["diskon"] / 100));
        }
        if ($request->has('id_Service') && $request->id_Service != '') {
            service::where('id_pemesanan', $id)->delete();
            $storeChildData['id_services'] = $updateData['id_Service'];
            $storeChildData['id_pemesanan'] = $id;
            $storeChildData['Time-Jumlah'] = 10;
            $Service = jenis_service::find($storeChildData['id_services']);
            if (is_null($Service)) {
                return response([
                    'message' => 'Barber Not found',
                ], 404);
            }
            $validate = Validator::make($storeChildData, [
                'id_pemesanan' => 'required',
                'id_services' => 'required',
                'Time-Jumlah' => 'required',
            ]);
            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }
            service::create($storeChildData);
        }


        $Pemesanan->update($updateData);

        return response([
            'message' => 'Pemesanan Updated Successfully',
            'data' => $Pemesanan,
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Pemesanan = pemesanan::find($id);

        if (is_null($Pemesanan)) {
            return response([
                'message' => 'Pemesanan Not Found',
                'data' => null
            ], 404);
        }

        if ($Pemesanan->delete()) {
            return response([
                'message' => 'Pemesanan Deleted Successfully',
                'data' => $Pemesanan,
            ], 200);
        }

        return response([
            'message' => 'Delete Pemesanan Failed',
            'data' => null,
        ], 400);
    }
}
