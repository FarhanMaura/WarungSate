<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with('table')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(\App\Models\Order $order)
    {
        $order->load('items.menu', 'table');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, \App\Models\Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:pending,cooking,served,completed,cancelled',
        ]);

        $order->update(['order_status' => $request->order_status]);

        return redirect()->back()->with('success', 'Order status updated.');
    }

    public function verifyPayment(\App\Models\Order $order)
    {
        $order->update(['payment_status' => 'paid']);
        return redirect()->back()->with('success', 'Payment verified.');
    }
}
