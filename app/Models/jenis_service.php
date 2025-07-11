<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_service extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_service';
    protected $fillable = [
        'id_service',
        'deskripsi',
        'nama',
        'namaIcon',
        'harga',
        'tipe',
        'ServiceOverview'
    ];
    protected $casts = [
        'id_service' => 'string', 
    ];
    public function Pemesanan()
    {
        return $this->belongsToMany(
            jenis_service::class,
            'services',
            'id_services',
            'id_pemesanan' 
            
        );
    }
    public function galery()
    {
        return $this->hasMany(galery::class, 'id_services', 'id_service');
    }
}
