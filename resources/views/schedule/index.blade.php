<!-- resources/views/schedules/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Jadwal')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Kelola Jadwal</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Jadwal</li>
            </ol>
        </nav>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Jadwal Perjalanan</h5>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>
    <div class="card-body">
        @if($schedules->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Rute</th>
                            <th>Tanggal</th>
                            <th>Waktu Keberangkatan</th>
                            <th>Waktu Tiba</th>
                            <th>Kursi Tersedia</th>
                            <th>Harga</th>
                            <th>Nomor Bus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->route }}</td>
                            <td>{{ $schedule->date->format('d/m/Y') }}</td>
                            <td>{{ $schedule->departure_time }}</td>
                            <td>{{ $schedule->arrival_time }}</td>
                            <td>{{ $schedule->available_seats }}</td>
                            <td>Rp {{ number_format($schedule->price, 0, ',', '.') }}</td>
                            <td>{{ $schedule->bus_number }}</td>
                            <td>
                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <p class="text-muted">Belum ada jadwal yang tersedia.</p>
                <a href="{{ route('schedules.create') }}" class="btn btn-primary-custom">Tambah Jadwal Pertama</a>
            </div>
        @endif
    </div>
</div>
@endsection