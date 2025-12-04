@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Item Pesanan</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
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
                            <th colspan="3" class="text-right">Total:</th>
                            <th>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Info Pesanan</h3>
            </div>
            <div class="card-body">
                <p><strong>Meja:</strong> {{ $order->table->table_number }}</p>
                <p><strong>Pelanggan:</strong> {{ $order->customer_name ?? 'Tamu' }}</p>
                <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                <p><strong>Status:</strong> <span class="badge badge-info">{{ ucfirst($order->order_status) }}</span></p>
                <p><strong>Pembayaran:</strong> <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }}">{{ ucfirst($order->payment_status) }}</span></p>
                
                <hr>
                
                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mb-2">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <select name="order_status" class="form-control">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cooking" {{ $order->order_status == 'cooking' ? 'selected' : '' }}>Memasak</option>
                            <option value="served" {{ $order->order_status == 'served' ? 'selected' : '' }}>Dihidangkan</option>
                            <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </span>
                    </div>
                </form>

                @if($order->payment_status == 'pending')
                <form action="{{ route('orders.verifyPayment', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Konfirmasi pembayaran diterima?')">Verifikasi Pembayaran</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
