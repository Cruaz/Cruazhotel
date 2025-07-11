<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galery extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_image';
    protected $fillable = [
        'id_image',
        'id_jenises',
        'id_services',
        'foto',
    ];
    protected $casts = [
        'id_image' => 'string', 
    ];
    public function Jenis()
    {
        return $this->belongsTo(jenis_kamar::class,'id_jenises', 'id_jenis');
    }
    public function Service()
    {
        return $this->belongsTo(jenis_service::class,'id_services', 'id_service');
    }
}
