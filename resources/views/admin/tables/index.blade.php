@extends('layouts.admin')

@section('title', 'Meja & QR')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Meja</h3>
        <div class="card-tools">
            <a href="{{ route('tables.create') }}" class="btn btn-primary btn-sm">Tambah Meja Baru</a>
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
                    <th>Nomor Meja</th>
                    <th>QR Code</th>
                    <th>URL Testing</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tables as $table)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $table->table_number }}</td>
                    <td>
                        @if($table->qr_code_path)
                            <img src="/{{ $table->qr_code_path }}" width="100px">
                            <br>
                            <a href="/{{ $table->qr_code_path }}" download class="btn btn-sm btn-info mt-1">Download QR</a>
                        @else
                            Tidak Ada QR
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('order.index', $table->uuid) }}" target="_blank" class="btn btn-sm btn-success">
                            <i class="fas fa-external-link-alt"></i> Buka Halaman Pemesanan
                        </a>
                        <br>
                        <small class="text-muted">{{ route('order.index', $table->uuid) }}</small>
                    </td>
                    <td>
                        @if($table->status == 'occupied')
                            <span class="badge badge-danger">Terisi</span>
                        @else
                            <span class="badge badge-success">Tersedia</span>
                        @endif
                    </td>
                    <td>
                        @if($table->status == 'occupied')
                            <form action="{{ route('tables.clear', $table->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Kosongkan meja ini?')">
                                    <i class="fas fa-broom"></i> Kosongkan
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('tables.destroy',$table->id) }}" method="POST" style="display:inline;">
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
