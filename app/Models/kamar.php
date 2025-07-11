<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class kamar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_kamar';
    protected $fillable = [
        'id_kamar',
        'id_jenises',
        'lantai',
        'Status',
    ];
    // protected $casts = [
    //     'id_kamar' => 'interger', 
    // ];
    public function jenis_kamar()
    {
        return $this->belongsTo(jenis_kamar::class, 'id_jenises', 'id_jenis');
    }
    public function kamar()
    {
        return $this->belongsToMany(
            kamar::class,
            'kamar_bookeds',
            'id_kamars',
            'id_bookings' 
            
        );
    }
    public function kamarBooked()
    {
        return $this->hasMany(kamar_booked::class, 'id_kamars', 'id_kamar');
    }
}
