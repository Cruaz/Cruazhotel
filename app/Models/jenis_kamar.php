<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_kamar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'id_jenis',
        'harga',
        'kapasitas',
        'nama',
        'tipe',
        'KamarOverview',
        'Deskripsi'
    ];
    protected $casts = [
        'id_jenis' => 'string', 
    ];
    public function fasilitas()
    {
        return $this->belongsToMany(
            fasilitas::class,
            'kamar_fasilitas',
            'id_jeniss', 
            'id_fasilitass'
        );
    }
    public function galery()
    {
        return $this->hasMany(galery::class, 'id_jenises', 'id_jenis');
    }
}
