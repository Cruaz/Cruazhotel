<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar_fasilitas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_jeniss',
        'id_fasilitass',
    ];
    public function fasilitas()
    {
        return $this->belongsTo(fasilitas::class, 'id_fasilitas');
    }
    public function jenis_kamar()
    {
        return $this->belongsTo(jenis_kamar::class, 'id_jenis');
    }
}
