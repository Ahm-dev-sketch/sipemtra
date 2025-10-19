<?php
// app/Http/Controllers/ScheduleController.php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Middleware untuk memastikan hanya admin yang bisa akses
    }

    // Menampilkan daftar jadwal (Step 1.1)
    public function index()
    {
        $schedules = Schedule::where('status', 'active')
                            ->orderBy('date', 'asc')
                            ->orderBy('departure_time', 'asc')
                            ->get();
        
        return view('schedules.index', compact('schedules'));
    }

    // Menampilkan form tambah jadwal (Step 2.1)
    public function create()
    {
        return view('schedules.create');
    }

    // Menyimpan jadwal baru (Step 4.1)
    public function store(Request $request)
    {
        // Validasi data (Step 3.1)
        $validated = $request->validate([
            'route' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'available_seats' => 'required|integer|min:1|max:50',
            'price' => 'required|numeric|min:0',
            'bus_number' => 'required|string|max:20',
            'driver_name' => 'required|string|max:100',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            // Simpan data ke database
            Schedule::create($validated);
            
            return redirect()->route('schedules.index')
                           ->with('success', 'Jadwal berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }
}