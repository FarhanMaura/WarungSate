@extends('layouts.admin')

@section('title', 'Daftar Menu')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Menu</h3>
        <div class="card-tools">
            <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm">Tambah Menu Baru</a>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th width="280px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($menu->image)
                            <img src="/images/{{ $menu->image }}" width="100px">
                        @else
                            Tidak Ada Gambar
                        @endif
                    </td>
                    <td>{{ $menu->name }}</td>
                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td>{{ $menu->category }}</td>
                    <td>{{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                    <td>
                        <form action="{{ route('menus.destroy',$menu->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('menus.edit',$menu->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
