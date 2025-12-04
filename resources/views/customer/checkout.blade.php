@extends('layouts.customer')

@section('title', 'Checkout - Sate Ordering')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Pesanan Anda</h4>
        
        @if(session('cart'))
            @php 
                $activeOrder = null;
                if ($table->status == 'occupied') {
                    $activeOrder = \App\Models\Order::where('table_id', $table->id)->latest()->first();
                }
            @endphp

            @if($activeOrder)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> <strong>Info:</strong> Anda sudah memiliki pesanan aktif. 
                Item baru akan ditambahkan ke pesanan yang sudah ada.
            </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>{{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td>{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">{{ $activeOrder ? 'Total Item Baru' : 'Grand Total' }}</td>
                            <td class="fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                        @if($activeOrder)
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Pesanan Sebelumnya</td>
                            <td class="fw-bold">Rp {{ number_format($activeOrder->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">GRAND TOTAL</td>
                            <td class="fw-bold text-success">Rp {{ number_format($total + $activeOrder->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>

            <form action="{{ route('order.placeOrder', request()->route('uuid')) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Anda <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control" 
                           placeholder="Nama Lengkap" 
                           value="{{ $activeOrder ? $activeOrder->customer_name : '' }}"
                           {{ $activeOrder ? 'readonly' : 'required' }}>
                    @if($activeOrder)
                    <small class="text-muted">Nama dari pesanan aktif</small>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="payment_method" class="form-select" {{ $activeOrder ? 'disabled' : 'required' }}>
                        <option value="Cash" {{ $activeOrder && $activeOrder->payment_method == 'Cash' ? 'selected' : '' }}>Cash (Bayar di Kasir)</option>
                        <option value="Transfer" {{ $activeOrder && $activeOrder->payment_method == 'Transfer' ? 'selected' : '' }}>Transfer Bank / QRIS</option>
                    </select>
                    @if($activeOrder)
                    <input type="hidden" name="payment_method" value="{{ $activeOrder->payment_method }}">
                    <small class="text-muted">Metode pembayaran dari pesanan aktif</small>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ $activeOrder ? 'Tambahkan ke Pesanan' : 'Pesan Sekarang' }}
                    </button>
                    <a href="{{ route('order.index', request()->route('uuid')) }}" class="btn btn-outline-secondary">Tambah Item Lagi</a>
                </div>
            </form>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
                <p>Keranjang Anda kosong.</p>
                <a href="{{ route('order.index', request()->route('uuid')) }}" class="btn btn-primary">Browse Menu</a>
            </div>
        @endif
    </div>
</div>
@endsection
