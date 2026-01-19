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
        
        <!-- Desktop Table View -->
        <div class="d-none d-lg-block">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Meja</th>
                        <th>QR Code</th>
                        <th>URL Testing</th>
                        <th>Status</th>
                        <th>Validasi Lokasi</th>
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
                                <img src="{{ $table->qr_code_path }}" width="100px">
                                <br>
                                <a href="{{ $table->qr_code_path }}" download class="btn btn-sm btn-info mt-1">Download QR</a>
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
                            @if($table->require_location)
                                <span class="badge badge-success"><i class="fas fa-check"></i> Aktif</span>
                            @else
                                <span class="badge badge-danger"><i class="fas fa-times"></i> Nonaktif</span>
                            @endif
                            <br>
                            <form action="{{ route('tables.toggle-location', $table->id) }}" method="POST" style="display:inline; margin-top: 5px;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning mt-1">
                                    <i class="fas fa-map-marker-alt"></i> Toggle
                                </button>
                            </form>
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

        <!-- Mobile Card View -->
        <div class="d-lg-none">
            @foreach ($tables as $table)
            <div class="card mb-3" style="border-left: 4px solid var(--admin-primary);">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-chair"></i> Meja {{ $table->table_number }}
                        @if($table->status == 'occupied')
                            <span class="badge badge-danger float-right">Terisi</span>
                        @else
                            <span class="badge badge-success float-right">Tersedia</span>
                        @endif
                    </h5>
                    
                    <div class="mb-3 text-center">
                        @if($table->qr_code_path)
                            <img src="{{ $table->qr_code_path }}" width="150px" class="img-fluid">
                            <br>
                            <a href="{{ $table->qr_code_path }}" download class="btn btn-sm btn-info mt-2">
                                <i class="fas fa-download"></i> Download QR
                            </a>
                        @else
                            <p class="text-muted">Tidak Ada QR</p>
                        @endif
                    </div>

                    <div class="mb-2">
                        <strong><i class="fas fa-map-marker-alt"></i> Validasi Lokasi:</strong>
                        @if($table->require_location)
                            <span class="badge badge-success"><i class="fas fa-check"></i> Aktif</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times"></i> Nonaktif</span>
                        @endif
                        <form action="{{ route('tables.toggle-location', $table->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning ml-2">
                                <i class="fas fa-sync"></i> Toggle
                            </button>
                        </form>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('order.index', $table->uuid) }}" target="_blank" class="btn btn-success btn-block">
                            <i class="fas fa-external-link-alt"></i> Buka Halaman Pemesanan
                        </a>
                    </div>

                    <div class="btn-group btn-block" role="group">
                        @if($table->status == 'occupied')
                            <form action="{{ route('tables.clear', $table->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-block" onclick="return confirm('Kosongkan meja ini?')">
                                    <i class="fas fa-broom"></i> Kosongkan
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('tables.destroy',$table->id) }}" method="POST" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
