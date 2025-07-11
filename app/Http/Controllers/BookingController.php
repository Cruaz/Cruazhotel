<?php

namespace App\Http\Controllers;

use App\Models\booking;
use App\Models\jenis_kamar;
use App\Models\kamar;
use App\Models\kamar_booked;
use App\Models\pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = booking::with('kamar');
        if ($request->has('search') && $request->search != '') {
            $query->where('id_booking', 'like', '%' . $request->search . '%');
        }
        $perPage = $request->query('per_page', 7);
        $Bookings = $query->paginate($perPage);

        return response([
            'message' => 'All Bookings Retrieved',
            'data' => $Bookings
        ], 200);
    }
    public function getData()
    {
        $data = booking::all();

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
        $data = booking::where('id_users', $idUser)->get();
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
    public function showBookingbyUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }
        $Bookings = booking::where('id_users', $user->id)->get();
        return response([
            'message' => 'Bookings of ' . $user->name . ' Retrieved',
            'data' => $Bookings
        ], 200);
    }

    public function countBooking()
    {
        $count = Booking::count();
        return response([
            'message' => 'Count Retrieved Successfully',
            'count' => $count
        ], 200);
    }
    public function countBookingByUser()
    {
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response(['message' => 'User Not Found'], 404);
        }
        $count = Booking::where('id_users', $idUser)->count();
        return response([
            'message' => 'Count Retrieved Successfully',
            'count' => $count
        ], 200);
    }

    public function getCombinedData()
    {
        $pesanan = pemesanan::where('Status', "Booked")->take(2)->get();
        $bookings = Booking::where('Status', "Booked")->take(2)->get();
        $pesanan->each(function ($item) {
            $item->type = 'Pesanan';
        });
        $bookings->each(function ($item) {
            $item->type = 'Booking';
        });
        $combinedData = $bookings->concat($pesanan);
        return response([
            'message' => 'Data Retrieved Successfully',
            'data' => $combinedData->values()
        ], 200);
    }
    public function getCombinedDataUser(Request $request)
    {
        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response(['message' => 'User Not Found'], 404);
        }
        $pesanan = pemesanan::where('id_users', $idUser)->where('Status', 'Booked')->with('service')->take(2)->get();
        $bookings = Booking::where('id_users', $idUser)->where('Status', 'Booked')->with('kamar')->take(2)->get();
        $pesanan->each(function ($item) {
            $item->type = 'Pesanan';
        });

        $bookings->each(function ($item) {
            $item->type = 'Booking';
        });
        $combinedData = $bookings->concat($pesanan);
        $perPage = 5;
        $currentPage = $request->input('page', 1);
        $paginatedData = new LengthAwarePaginator(
            $combinedData->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $combinedData->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        return response([
            'message' => 'Data Retrieved Successfully',
            'data' => $paginatedData
        ], 200);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'CheckIn' => 'required|date',
            'CheckOut' => 'required|date|after:CheckIn',
            'Status' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'Data' => 'required|array',
            'Data.*.id_jenisses' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $idUser = Auth::id();
        $user = User::find($idUser);
        if (is_null($user)) {
            return response(['message' => 'User Not Found'], 404);
        }
        $storeData['id_users'] = $user->id_user;
        $lastId = booking::latest('id_booking')->first();
        $newId = $lastId ? 'B' . str_pad((int) substr($lastId->id_booking, 1) + 1, 3, '0', STR_PAD_LEFT) : 'B001';
        $storeData['id_booking'] = $newId;
        $totalHarga = 0;
        foreach ($storeData['Data'] as $index => $item) {
            $rooms = kamar::where('id_jenises', $item['id_jenisses'])->get();
            if ($rooms->isEmpty()) {
                return response(['message' => 'No rooms available for the selected type'], 404);
            }
            $selectedRoom = $rooms->random();
            $JenisKamar = jenis_kamar::find($selectedRoom->id_jenises);
            $totalHarga += $JenisKamar ? (int) $JenisKamar->harga : 0;
            $storeData['Data'][$index]['id_kamars'] = $selectedRoom->id_kamar;
        }
        $storeData['total_harga'] = $totalHarga - ($totalHarga * ($storeData['diskon'] ?? 0) / 100);
        $Bookings = booking::create($storeData);
        foreach ($storeData['Data'] as $item) {
            $lastIdChild = kamar_booked::latest('id_kamar_booked')->first();
            $newIdChild = $lastIdChild ? 'KB' . str_pad((int) substr($lastIdChild->id_kamar_booked, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';
            kamar_booked::create([
                'id_kamar_booked' => $newIdChild,
                'id_bookings' => $newId,
                'id_kamars' => $item['id_kamars'],
            ]);
        }

        return response([
            'message' => 'Booking Added Successfully',
            'data' => $Bookings,
        ], 200);
    }

    public function storeDashboard(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'CheckIn' => 'required',
            'CheckOut' => 'required',
            'Status' => '',
            'total_harga' => '',
            'diskon' => ''
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
        $lastId = booking::latest('id_booking')->first();
        $newId = $lastId ? 'B' . str_pad((int) substr($lastId->id_booking, 1) + 1, 3, '0', STR_PAD_LEFT) : 'B001';
        $storeData['id_booking'] = $newId;
        $storeData['total_harga'] = $storeData['total_harga'] - ($storeData['total_harga'] * $storeData["diskon"] / 100);
        $Bookings = booking::create($storeData);


        $storeChildData['id_kamars'] = $storeData['id_kamars'];
        $storeChildData['id_bookings'] = $newId;

        $kamar = kamar::find($storeData['id_kamars']);
        if (is_null($kamar)) {
            return response([
                'message' => 'Room Not found',
            ], 404);
        }

        $lastIdChild = kamar_booked::latest('id_kamar_booked')->first();
        $newIdChild = $lastIdChild ? 'KB' . str_pad((int) substr($lastIdChild->id_kamar_booked, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';
        $storeChildData['id_kamar_booked'] = $newIdChild;

        $validate = Validator::make($storeChildData, [
            'id_bookings' => 'required',
            'id_kamars' => 'required',
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        kamar_booked::create($storeChildData);


        return response([
            'message' => 'Booking Added Successfully',
            'data' => $Bookings,
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Bookings = booking::find($id);

        if ($Bookings) {
            return response([
                'message' => 'Booking Found',
                'data' => $Bookings
            ], 200);
        }

        return response([
            'message' => 'Booking Not Found',
            'data' => null
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Booking = booking::find($id);
        if (is_null($Booking)) {
            return response([
                'message' => 'Booking Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'CheckIn' => 'required',
            'CheckOut' => 'required',
            'Status' => '',
            'total_harga' => '',
            'diskon' => ''
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
        kamar_booked::where('id_bookings', $id)->delete();
        foreach ($request->Data as $item) {
            $Kamar = kamar::find($item['id_kamars']);
            if (is_null($Kamar)) {
                return response([
                    'message' => 'Kamar Not found',
                ], 404);
            }
            $JenisKamar = jenis_kamar::find($Kamar->id_jenises);
            $p += (int)$JenisKamar->harga;

            $storeChildData = $item;
            $storeChildData['id_bookings'] = $id;
            $kamar = kamar::find($item['id_kamars']);
            if (is_null($kamar)) {
                return response([
                    'message' => 'Barber Not found',
                ], 404);
            }
            $lastIdChild = kamar_booked::latest('id_kamar_booked')->first();
            $newIdChild = $lastIdChild ? 'KB' . str_pad((int) substr($lastIdChild->id_kamar_booked, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';
            $storeChildData['id_kamar_booked'] = $newIdChild;
            $validate = Validator::make($storeChildData, [
                'id_bookings' => 'required',
                'id_kamars' => 'required',
            ]);
            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }
            kamar_booked::create($storeChildData);
        }
        $updateData['total_harga'] = $p - ($p * $updateData["diskon"] / 100);

        $Booking->update($updateData);

        return response([
            'message' => 'Booking Updated Successfully',
            'data' => $Booking,
        ], 200);
    }
    public function updateDashboard(Request $request, string $id)
    {
        $Booking = booking::find($id);
        if (is_null($Booking)) {
            return response([
                'message' => 'Booking Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($updateData, [
            'CheckIn' => 'required',
            'CheckOut' => 'required',
            'Status' => '',
            'total_harga' => '',
            'diskon' => ''
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
        $updateData['total_harga'] = $updateData['total_harga'] - ($updateData['total_harga'] * $updateData["diskon"] / 100);



        if ($request->has('id_kamars') && $request->id_kamars != '') {
            $kamar = kamar::find($updateData['id_kamars']);
            if (is_null($kamar)) {
                return response([
                    'message' => 'Room Not 4 found',
                ], 404);
            }
            kamar_booked::where('id_bookings', $id)->delete();
            $storeChildData['id_kamars'] = $updateData['id_kamars'];
            $storeChildData['id_bookings'] = $id;
            $lastIdChild = kamar_booked::latest('id_kamar_booked')->first();
            $newIdChild = $lastIdChild ? 'KB' . str_pad((int) substr($lastIdChild->id_kamar_booked, 2) + 1, 3, '0', STR_PAD_LEFT) : 'KB001';
            $storeChildData['id_kamar_booked'] = $newIdChild;

            $validate = Validator::make($storeChildData, [
                'id_bookings' => 'required',
                'id_kamars' => 'required',
            ]);
            if ($validate->fails()) {
                return response(['message' => $validate->errors()], 400);
            }
            kamar_booked::create($storeChildData);
        }
        $Booking->update($updateData);

        return response([
            'message' => 'Booking Updated Successfully',
            'data' => $Booking,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Bookings = booking::find($id);

        if (is_null($Bookings)) {
            return response([
                'message' => 'Booking Not Found',
                'data' => null
            ], 404);
        }

        if ($Bookings->delete()) {
            return response([
                'message' => 'Booking Deleted Successfully',
                'data' => $Bookings,
            ], 200);
        }

        return response([
            'message' => 'Delete Booking Failed',
            'data' => null,
        ], 400);
    }
}
