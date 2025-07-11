<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_fasilitas';
    protected $fillable = [
        'id_fasilitas',
        'deskripsi',
        'nama',
        'namaIcon',
    ];
    protected $casts = [
        'id_fasilitas' => 'string', 
    ];
    public function jenisKamar()
    {
        return $this->belongsToMany(
            jenis_kamar::class,
            'kamar_fasilitas', 
            'id_fasilitass', 
            'id_jeniss' 
        );
    }
}
