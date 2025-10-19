<!-- resources/views/schedules/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Tambah Jadwal Baru</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Kelola Jadwal</a></li>
                <li class="breadcrumb-item active">Tambah Jadwal</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="route" class="form-label">Rute Perjalanan *</label>
                    <input type="text" class="form-control @error('route') is-invalid @enderror" 
                           id="route" name="route" value="{{ old('route') }}" 
                           placeholder="Contoh: Jakarta - Bandung" required>
                    @error('route')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Tanggal Keberangkatan *</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" 
                           id="date" name="date" value="{{ old('date') }}" 
                           min="{{ date('Y-m-d') }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="departure_time" class="form-label">Waktu Keberangkatan *</label>
                    <input type="time" class="form-control @error('departure_time') is-invalid @enderror" 
                           id="departure_time" name="departure_time" value="{{ old('departure_time') }}" required>
                    @error('departure_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="arrival_time" class="form-label">Waktu Tiba *</label>
                    <input type="time" class="form-control @error('arrival_time') is-invalid @enderror" 
                           id="arrival_time" name="arrival_time" value="{{ old('arrival_time') }}" required>
                    @error('arrival_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="available_seats" class="form-label">Jumlah Kursi Tersedia *</label>
                    <input type="number" class="form-control @error('available_seats') is-invalid @enderror" 
                           id="available_seats" name="available_seats" value="{{ old('available_seats') }}" 
                           min="1" max="50" required>
                    @error('available_seats')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Harga Tiket (Rp) *</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price') }}" 
                           min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="bus_number" class="form-label">Nomor Bus *</label>
                    <input type="text" class="form-control @error('bus_number') is-invalid @enderror" 
                           id="bus_number" name="bus_number" value="{{ old('bus_number') }}" 
                           placeholder="Contoh: B 1234 ABC" required>
                    @error('bus_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="driver_name" class="form-label">Nama Sopir *</label>
                    <input type="text" class="form-control @error('driver_name') is-invalid @enderror" 
                           id="driver_name" name="driver_name" value="{{ old('driver_name') }}" required>
                    @error('driver_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Catatan Tambahan</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" name="notes" rows="3" 
                          placeholder="Catatan tambahan mengenai perjalanan...">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save"></i> Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Validasi client-side untuk memastikan waktu tiba setelah waktu keberangkatan
    document.addEventListener('DOMContentLoaded', function() {
        const departureTime = document.getElementById('departure_time');
        const arrivalTime = document.getElementById('arrival_time');
        
        function validateTimes() {
            if (departureTime.value && arrivalTime.value) {
                if (arrivalTime.value <= departureTime.value) {
                    arrivalTime.setCustomValidity('Waktu tiba harus setelah waktu keberangkatan');
                } else {
                    arrivalTime.setCustomValidity('');
                }
            }
        }
        
        departureTime.addEventListener('change', validateTimes);
        arrivalTime.addEventListener('change', validateTimes);
    });
</script>
@endpush