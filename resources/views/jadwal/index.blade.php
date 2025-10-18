@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Jadwal</h3>

    <a href="{{ route('jadwal.create') }}" class="btn btn-success mb-3">+ Tambah Jadwal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rute</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Harga</th>
                <th>Kursi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwals as $jadwal)
            <tr>
                <td>{{ $jadwal->id }}</td>
                <td>{{ $jadwal->rute }}</td>
                <td>{{ $jadwal->tanggal_keberangkatan }}</td>
                <td>{{ $jadwal->waktu_keberangkatan }}</td>
                <td>Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                <td>{{ $jadwal->jumlah_kursi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
