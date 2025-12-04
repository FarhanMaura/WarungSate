@extends('layouts.customer')

@section('title', 'Status Pesanan - Sate Ordering')

@push('css')
<style>
    /* Print Styles */
    @media print {
        .page-header {
            display: none !important;
        }
        
        #receipt {
            border: 2px solid #000 !important;
            page-break-inside: avoid;
        }
        
        #receipt .card-body {
            padding: 20px !important;
        }
        
        #receipt h5 {
            font-size: 18px !important;
            margin-bottom: 15px !important;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        
        #receipt .table {
            border: 1px solid #000 !important;
        }
        
        #receipt .table th,
        #receipt .table td {
            border: 1px solid #000 !important;
            padding: 8px !important;
            color: #000 !important;
        }
        
        #receipt .badge {
            border: 1px solid #000 !important;
            padding: 4px 8px !important;
        }
        
        #receipt .alert {
            border: 2px solid #000 !important;
            padding: 10px !important;
        }
        
        /* Print header */
        #receipt::before {
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
    <div class="mb-3">
        @if($order->order_status == 'pending')
            <i class="fas fa-clock fa-4x text-warning"></i>
        @elseif($order->order_status == 'cooking')
            <i class="fas fa-fire fa-4x text-danger"></i>
        @elseif($order->order_status == 'served')
            <i class="fas fa-concierge-bell fa-4x text-success"></i>
        @elseif($order->order_status == 'completed')
            <i class="fas fa-check-circle fa-4x text-success"></i>
        @else
            <i class="fas fa-times-circle fa-4x text-muted"></i>
        @endif
    </div>
    <h2>Status Pesanan Anda</h2>
    <p class="lead text-{{ $order->order_status == 'completed' ? 'success' : 'warning' }}">
        Status: {{ ucfirst($order->order_status) }}
    </p>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card mb-4" id="receipt">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-receipt text-warning no-print"></i> Detail Pesanan
                    </h5>
                    <button onclick="printReceipt()" class="btn btn-sm btn-primary no-print">
                        <i class="fas fa-print"></i> Cetak Struk
                    </button>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6">
                        <p class="mb-1"><strong>Meja:</strong> {{ $order->table->table_number }}</p>
                        <p class="mb-1"><strong>Nama:</strong> {{ $order->customer_name ?? 'Tamu' }}</p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-6">
                        <p class="mb-1"><strong>Status Pesanan:</strong> 
                            <span class="badge bg-{{ $order->order_status == 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </p>
                        <p class="mb-1"><strong>Status Pembayaran:</strong> 
                            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                        <p class="mb-1"><strong>Metode:</strong> {{ $order->payment_method }}</p>
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
                        @foreach($order->items as $item)
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
                            <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>

                <hr>

                @if($order->payment_method == 'Transfer' && $order->payment_status == 'pending')
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Silakan Transfer ke:</h6>
                        <a href="{{ route('order.paymentInfo', $order->table->uuid) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-credit-card"></i> Lihat Info Pembayaran Lengkap
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="d-grid gap-2 no-print">
            <button onclick="window.location.reload()" class="btn btn-outline-primary">
                <i class="fas fa-sync"></i> Refresh Status
            </button>
            <a href="{{ route('order.index', $order->table->uuid) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Menu
            </a>
        </div>
    </div>
</div>

@push('js')
<script>
function printReceipt() {
    window.print();
}
</script>
@endpush
@endsection
