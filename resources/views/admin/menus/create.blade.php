@extends('layouts.admin')

@section('title', 'Tambah Menu Baru')

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

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="name" class="form-control" placeholder="Nama">
            </div>
            <div class="form-group">
                <label>Deskripsi:</label>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label>Harga:</label>
                <input type="number" name="price" class="form-control" placeholder="Harga">
            </div>
            <div class="form-group">
                <label>Kategori:</label>
                <select name="category" class="form-control">
                    <option value="Food">Makanan</option>
                    <option value="Drink">Minuman</option>
                    <option value="Snack">Camilan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar:</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Ketersediaan:</label>
                <select name="is_available" class="form-control">
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a class="btn btn-secondary" href="{{ route('menus.index') }}">Kembali</a>
        </form>
    </div>
</div>
@endsection
