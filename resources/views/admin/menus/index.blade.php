@extends('layouts.admin')

@section('title', 'Daftar Menu')

@section('content')
<style>
    .menu-grid {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .menu-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .menu-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .menu-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--admin-primary);
    }

    .menu-category {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-secondary));
        color: white;
    }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-utensils"></i> Daftar Menu</h3>
        <div class="card-tools">
            <a href="{{ route('menus.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Menu Baru
            </a>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ $message }}
            </div>
        @endif

        <div class="row menu-grid">
            @forelse ($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card menu-card">
                    <div style="position: relative;">
                        @if($menu->image)
                            <img src="/images/{{ $menu->image }}" class="menu-image" alt="{{ $menu->name }}">
                        @else
                            <div class="menu-image" style="background: linear-gradient(135deg, #e0e0e0, #bdbdbd); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-utensils" style="font-size: 4rem; color: #999;"></i>
                            </div>
                        @endif
                        
                        <span class="stock-badge badge-{{ $menu->is_available ? 'success' : 'danger' }}">
                            {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: 700; margin-bottom: 10px;">{{ $menu->name }}</h5>
                        
                        <div class="mb-2">
                            <span class="menu-category">{{ $menu->category }}</span>
                        </div>
                        
                        <div class="menu-price mb-3">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </div>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-info btn-sm flex-fill">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> Belum ada menu. Silakan tambah menu baru.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
