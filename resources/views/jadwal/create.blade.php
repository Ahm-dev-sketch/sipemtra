@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Jadwal Keberangkatan</h3>

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Rute</label>
            <input type="text" name="rute" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Keberangkatan</label>
            <input type="date" name="tanggal_keberangkatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Waktu Keberangkatan</label>
            <input type="time" name="waktu_keberangkatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Kursi</label>
            <input type="number" name="jumlah_kursi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga Tiket</label>
            <input type="number" step="0.01" name="harga_tiket" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Sopir (Opsional)</label>
            <input type="text" name="nama_sopir" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nomor Kendaraan (Opsional)</label>
            <input type="text" name="nomor_kendaraan" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
