<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_pemesanan',
        'id_services',
        'Time-Jumlah',
    ];
    public function Service()
    {
        return $this->belongsTo(jenis_service::class, 'id_services','id_service');
    }
    public function Pemesanan()
    {
        return $this->belongsTo(pemesanan::class, 'id_pemesanan');
    }
}
