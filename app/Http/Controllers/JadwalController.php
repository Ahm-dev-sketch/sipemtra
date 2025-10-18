<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rute' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'waktu_keberangkatan' => 'required',
            'jumlah_kursi' => 'required|integer|min:1',
            'harga_tiket' => 'required|numeric|min:0',
            'nama_sopir' => 'nullable|string|max:255',
            'nomor_kendaraan' => 'nullable|string|max:255',
        ]);

        Jadwal::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'rute' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'waktu_keberangkatan' => 'required',
            'jumlah_kursi' => 'required|integer|min:1',
            'harga_tiket' => 'required|numeric|min:0',
            'nama_sopir' => 'nullable|string|max:255',
            'nomor_kendaraan' => 'nullable|string|max:255',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
