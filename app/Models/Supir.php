<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'mobil_id',
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
