<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisOlahraga extends Model
{
    protected $table = 'jenis_olahraga';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function lapangan()
    {
        return $this->hasMany(Lapangan::class, 'jenis_olahraga_id');
    }
}