@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Laporan Penjualan</h3>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-calendar-day"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Hari Ini</span>
                        <span class="info-box-number">Rp {{ number_format($today, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-calendar-week"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Minggu Ini</span>
                        <span class="info-box-number">Rp {{ number_format($week, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Bulan Ini</span>
                        <span class="info-box-number">Rp {{ number_format($month, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tahun Ini</span>
                        <span class="info-box-number">Rp {{ number_format($year, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <h5>Pesanan Terbayar</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meja</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Metode Pembayaran</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paidOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->table->table_number }}</td>
                    <td>{{ $order->customer_name ?? 'Tamu' }}</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $order->payment_method }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
