<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_booking';
    protected $fillable = [
        'id_booking',
        'id_users',
        'CheckIn',
        'CheckOut',
        'Status',
        'total_harga',
        'diskon',
    ];
    protected $casts = [
        'id_booking' => 'string', 
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users','id_user');
    }
    public function kamar()
    {
        return $this->belongsToMany(
            kamar::class,
            'kamar_bookeds',
            'id_bookings', 
            'id_kamars'
        );
    }
    public function kamarBooked()
    {
        return $this->hasMany(kamar_booked::class, 'id_bookings', 'id_booking');
    }
}
