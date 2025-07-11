<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar_booked extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_kamar_booked';
    protected $fillable = [
        'id_kamar_booked',
        'id_bookings',
        'id_kamars',
    ];
    protected $casts = [
        'id_kamar_booked' => 'string', 
    ];
    public function booking()
    {
        return $this->belongsTo(booking::class, 'id_bookings','id_booking');
    }
    public function Kamar()
    {
        return $this->belongsTo(kamar::class, 'id_kamars','id_kamar');
    }
}
