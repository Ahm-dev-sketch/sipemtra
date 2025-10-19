<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'route',
        'date',
        'departure_time',
        'arrival_time',
        'available_seats',
        'price',
        'bus_number',
        'driver_name',
        'notes',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'departure_time' => 'datetime:H:i',
        'arrival_time' => 'datetime:H:i',
        'price' => 'decimal:2'
    ];
}