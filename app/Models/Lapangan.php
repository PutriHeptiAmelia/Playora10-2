<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'lapangan';
    public $timestamps = false;

    protected $fillable = [
        'jenis_olahraga_id',
        'nama',
        'harga_per_jam',
        'status',
        'fasilitas',
    ];

    public function jenisOlahraga()
    {
        return $this->belongsTo(JenisOlahraga::class, 'jenis_olahraga_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'lapangan_id');
    }
}