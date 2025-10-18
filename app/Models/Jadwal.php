<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'rute',
        'tanggal_keberangkatan',
        'waktu_keberangkatan',
        'jumlah_kursi',
        'harga_tiket',
        'nama_sopir',
        'nomor_kendaraan'
    ];
}

