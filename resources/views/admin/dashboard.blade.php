@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .stats-card {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .stats-card:nth-child(1) { animation-delay: 0.1s; }
    .stats-card:nth-child(2) { animation-delay: 0.2s; }
    .stats-card:nth-child(3) { animation-delay: 0.3s; }
    .stats-card:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .chart-card {
        animation: fadeIn 0.8s ease-out 0.5s;
        animation-fill-mode: both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-lg-3 col-6 stats-card">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rp {{ number_format($today, 0, ',', '.') }}</h3>
                <p>Penjualan Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-cash-register"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6 stats-card">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp {{ number_format($week, 0, ',', '.') }}</h3>
                <p>Penjualan Minggu Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6 stats-card">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Rp {{ number_format($month, 0, ',', '.') }}</h3>
                <p>Penjualan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6 stats-card">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Rp {{ number_format($year, 0, ',', '.') }}</h3>
                <p>Penjualan Tahun Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <!-- Sales Trend Chart -->
    <div class="col-lg-8 chart-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area"></i> Tren Penjualan</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="80"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4 chart-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Statistik Cepat</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-info mb-3">
                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pesanan</span>
                        <span class="info-box-number">{{ $totalOrders ?? 0 }}</span>
                    </div>
                </div>
                <div class="info-box bg-success mb-3">
                    <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pesanan Selesai</span>
                        <span class="info-box-number">{{ $completedOrders ?? 0 }}</span>
                    </div>
                </div>
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pesanan Pending</span>
                        <span class="info-box-number">{{ $pendingOrders ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row">
    <div class="col-12 chart-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-receipt"></i> Pesanan Terbaru</h3>
                <div class="card-tools">
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i> Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Meja</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td><i class="fas fa-table"></i> Meja {{ $order->table->table_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td><strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></td>
                            <td>
                                @php
                                    $statusClass = 'status-badge-' . $order->order_status;
                                @endphp
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Sales Trend Chart
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Hari Ini', 'Minggu Ini', 'Bulan Ini', 'Tahun Ini'],
        datasets: [{
            label: 'Penjualan (Rp)',
            data: [
                {{ $today }},
                {{ $week }},
                {{ $month }},
                {{ $year }}
            ],
            borderColor: '#FF8C42',
            backgroundColor: 'rgba(255, 140, 66, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#8B4513',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: {
                        family: 'Outfit',
                        size: 14,
                        weight: '600'
                    }
                }
            },
            tooltip: {
                backgroundColor: 'rgba(139, 69, 19, 0.9)',
                titleFont: {
                    family: 'Outfit',
                    size: 14
                },
                bodyFont: {
                    family: 'Outfit',
                    size: 13
                },
                padding: 12,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    },
                    font: {
                        family: 'Outfit'
                    }
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                ticks: {
                    font: {
                        family: 'Outfit',
                        weight: '600'
                    }
                },
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>
@endpush
