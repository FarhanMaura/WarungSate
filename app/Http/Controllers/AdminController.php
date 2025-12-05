<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $today = \App\Models\Order::whereDate('created_at', today())->where('payment_status', 'paid')->sum('total_amount');
        $week = \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('payment_status', 'paid')->sum('total_amount');
        $month = \App\Models\Order::whereMonth('created_at', now()->month)->where('payment_status', 'paid')->sum('total_amount');
        $year = \App\Models\Order::whereYear('created_at', now()->year)->where('payment_status', 'paid')->sum('total_amount');

        // Order statistics
        $totalOrders = \App\Models\Order::count();
        $completedOrders = \App\Models\Order::where('order_status', 'completed')->count();
        $pendingOrders = \App\Models\Order::where('order_status', 'pending')->count();

        // Recent orders (last 10)
        $recentOrders = \App\Models\Order::with('table')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('today', 'week', 'month', 'year', 'totalOrders', 'completedOrders', 'pendingOrders', 'recentOrders'));
    }

    public function reports()
    {
        $today = \App\Models\Order::whereDate('created_at', today())->where('payment_status', 'paid')->sum('total_amount');
        $week = \App\Models\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('payment_status', 'paid')->sum('total_amount');
        $month = \App\Models\Order::whereMonth('created_at', now()->month)->where('payment_status', 'paid')->sum('total_amount');
        $year = \App\Models\Order::whereYear('created_at', now()->year)->where('payment_status', 'paid')->sum('total_amount');
        $paidOrders = \App\Models\Order::with('table')->where('payment_status', 'paid')->orderBy('created_at', 'desc')->get();

        return view('admin.reports', compact('today', 'week', 'month', 'year', 'paidOrders'));
    }
}
