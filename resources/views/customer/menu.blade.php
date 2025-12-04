@extends('layouts.customer')

@section('title', 'Menu - Sate Ordering')

@push('css')
<style>
    .quantity-selector {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 10px;
    }
    
    .quantity-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    body.dark-mode .quantity-btn {
        background: #2D2D2D;
        border-color: #444;
        color: #F7F7F7;
    }
    
    .quantity-btn:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 6px;
        font-weight: 600;
    }
    
    body.dark-mode .quantity-input {
        background: #1A1A1A;
        border-color: #444;
        color: #F7F7F7;
    }

    /* Print Styles */
    @media print {
        .menu-list {
            display: none !important;
        }
        
        .page-header {
            display: none !important;
        }
        
        #active-order {
            border: 2px solid #000 !important;
            page-break-inside: avoid;
        }
        
        #active-order .card-body {
            padding: 20px !important;
        }
        
        #active-order h5 {
            font-size: 18px !important;
            margin-bottom: 15px !important;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        #active-order .table {
            border: 1px solid #000 !important;
        }
        
        #active-order .table th,
        #active-order .table td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            color: #000 !important;
        }
        
        #active-order .badge {
            border: 1px solid #000 !important;
            padding: 4px 8px !important;
        }
        
        #active-order .alert {
            border: 2px solid #000 !important;
            padding: 10px !important;
        }
        
        /* Print header */
        #active-order::before {
            content: "STRUK PESANAN";
            display: block;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="text-center mb-4 page-header">
    <h1 class="display-6">Meja {{ $table->table_number }}</h1>
    <p class="text-muted">Pilih menu favorit Anda</p>
</div>

@if($activeOrder)
<div class="card mb-4 border-warning" id="active-order">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-receipt text-warning no-print"></i> Pesanan Aktif
            </h5>
            <button onclick="printActiveOrder()" class="btn btn-sm btn-primary no-print">
                <i class="fas fa-print"></i> Cetak Struk
            </button>
        </div>
        
        <div class="row mb-3">
            <div class="col-6">
                <p class="mb-1"><strong>Meja:</strong> {{ $table->table_number }}</p>
                <p class="mb-1"><strong>Nama:</strong> {{ $activeOrder->customer_name ?? 'Tamu' }}</p>
                <p class="mb-1"><strong>Tanggal:</strong> {{ $activeOrder->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="col-6">
                <p class="mb-1"><strong>Status Pesanan:</strong> 
                    <span class="badge bg-{{ $activeOrder->order_status == 'served' ? 'success' : 'warning' }}">
                        {{ ucfirst($activeOrder->order_status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Status Pembayaran:</strong> 
                    <span class="badge bg-{{ $activeOrder->payment_status == 'paid' ? 'success' : 'danger' }}">
                        {{ ucfirst($activeOrder->payment_status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Metode:</strong> {{ $activeOrder->payment_method }}</p>
            </div>
        </div>
        
        <hr>
        
        <h6>Detail Pesanan:</h6>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activeOrder->items as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">TOTAL:</th>
                    <th>Rp {{ number_format($activeOrder->total_amount, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        
        @if($activeOrder->payment_method == 'Transfer' && $activeOrder->payment_status == 'pending')
        <div class="alert alert-info mb-0">
            <small><i class="fas fa-info-circle"></i> Silakan transfer ke Bank BCA: 1234567890 (Sate Enak) atau scan QRIS di kasir.</small>
        </div>
        @endif
        
        <div class="d-grid mt-3 no-print">
            <a href="{{ route('order.status', ['uuid' => $table->uuid, 'order' => $activeOrder->id]) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-eye"></i> Lihat Detail Lengkap
            </a>
        </div>
    </div>
</div>
@endif

<div class="row menu-list">
    @foreach($menus as $menu)
    <div class="col-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100">
            @if($menu->image)
                <img src="/images/{{ $menu->image }}" class="card-img-top" alt="{{ $menu->name }}" style="height: 150px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 150px;">
                    <i class="fas fa-utensils fa-2x"></i>
                </div>
            @endif
            <div class="card-body p-3">
                <h5 class="card-title" style="font-size: 1rem;">{{ $menu->name }}</h5>
                <p class="card-text text-primary fw-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                
                <form action="{{ route('order.addToCart', request()->route('uuid')) }}" method="POST" id="form-{{ $menu->id }}">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    
                    <div class="quantity-selector">
                        <button type="button" class="quantity-btn" onclick="decrementQty({{ $menu->id }})">−</button>
                        <input type="number" name="quantity" id="qty-{{ $menu->id }}" value="1" min="1" max="100" class="quantity-input" onchange="validateQty({{ $menu->id }})">
                        <button type="button" class="quantity-btn" onclick="incrementQty({{ $menu->id }})">+</button>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('js')
<script>
function printActiveOrder() {
    window.print();
}

function incrementQty(menuId) {
    const input = document.getElementById('qty-' + menuId);
    let value = parseInt(input.value) || 1;
    if (value < 100) {
        input.value = value + 1;
    }
}

function decrementQty(menuId) {
    const input = document.getElementById('qty-' + menuId);
    let value = parseInt(input.value) || 1;
    if (value > 1) {
        input.value = value - 1;
    }
}

function validateQty(menuId) {
    const input = document.getElementById('qty-' + menuId);
    let value = parseInt(input.value) || 1;
    
    if (value < 1) {
        input.value = 1;
    } else if (value > 100) {
        input.value = 100;
    }
}
</script>
@endpush
@endsection
