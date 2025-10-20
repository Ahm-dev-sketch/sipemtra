<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [
        'nomor_polisi',
        'jenis',
        'kapasitas',
        'tahun',
        'merk',
        'status',
    ];

    public function supir()
    {
        return $this->hasOne(Supir::class);
    }
}
