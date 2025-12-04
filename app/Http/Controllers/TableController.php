<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = \App\Models\Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|unique:tables,table_number',
        ]);

        $uuid = \Illuminate\Support\Str::uuid();
        
        // Generate QR Code
        // We will generate a URL: domain.com/order/{uuid}
        $url = route('order.index', $uuid);
        
        // Save QR Code image
        $qrName = 'qr-' . $request->table_number . '.svg';
        $path = public_path('qrcodes/' . $qrName);
        
        // Ensure directory exists
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0777, true);
        }

        \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate($url, $path);

        \App\Models\Table::create([
            'table_number' => $request->table_number,
            'uuid' => $uuid,
            'qr_code_path' => 'qrcodes/' . $qrName,
        ]);

        return redirect()->route('tables.index')
                        ->with('success','Table created successfully.');
    }

    public function destroy(\App\Models\Table $table)
    {
        // Delete QR file
        if (file_exists(public_path($table->qr_code_path))) {
            unlink(public_path($table->qr_code_path));
        }
        
        $table->delete();

        return redirect()->route('tables.index')
                        ->with('success','Table deleted successfully');
    }

    public function clearTable(\App\Models\Table $table)
    {
        // Mark all active orders for this table as completed
        \App\Models\Order::where('table_id', $table->id)
            ->whereIn('order_status', ['pending', 'cooking', 'served'])
            ->update(['order_status' => 'completed']);

        // Set table status to available
        $table->status = 'available';
        $table->save();

        return redirect()->route('tables.index')
                        ->with('success', 'Meja berhasil dikosongkan');
    }
}
