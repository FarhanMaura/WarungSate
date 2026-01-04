@extends('layouts.admin')

@section('title', 'Tambah Meja Baru')

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Ada masalah dengan input Anda.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tables.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nomor Meja:</label>
                <input type="text" name="table_number" class="form-control" placeholder="contoh: 1, 2, A1" required>
            </div>
            
            <div class="form-group mt-3">
                <label>Latitude Lokasi Meja:</label>
                <input type="text" name="location_lat" class="form-control" placeholder="contoh: -6.175392" step="any" required>
                <small class="text-muted">Koordinat latitude lokasi meja (Google Maps)</small>
            </div>
            
            <div class="form-group mt-3">
                <label>Longitude Lokasi Meja:</label>
                <input type="text" name="location_lng" class="form-control" placeholder="contoh: 106.827153" step="any" required>
                <small class="text-muted">Koordinat longitude lokasi meja (Google Maps)</small>
            </div>
            
            <div class="alert alert-info mt-3">
                <strong><i class="fas fa-info-circle"></i> Cara mendapatkan koordinat:</strong><br>
                1. Buka Google Maps<br>
                2. Klik kanan pada lokasi meja → "What's here?"<br>
                3. Copy koordinat yang muncul (format: latitude, longitude)
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Generate QR & Simpan</button>
            <a class="btn btn-secondary mt-3" href="{{ route('tables.index') }}">Kembali</a>
        </form>
    </div>
</div>
@endsection
