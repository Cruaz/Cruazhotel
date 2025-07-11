<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'id_pemesanan',
        'id_users',
        'Tgl_pemesanan',
        'Status',
        'total_harga',
        'diskon',
    ];
    protected $casts = [
        'id_pemesanan' => 'string', 
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users','id_user');
    }
    public function Service()
    {
        return $this->belongsToMany(
            jenis_service::class,
            'services',
            'id_pemesanan', 
            'id_services'
        );
    }
}
