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
            'location_lat' => 'required|numeric|between:-90,90',
            'location_lng' => 'required|numeric|between:-180,180',
        ]);

        $uuid = \Illuminate\Support\Str::uuid();
        
        // Generate QR Code URL
        $url = route('order.index', $uuid);
        
        // Save QR Code as SVG (reliable, no extension needed)
        $qrName = 'qr-' . $request->table_number . '.svg';
        $qrPath = public_path('qrcodes/' . $qrName);
        
        // Ensure directory exists
        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0777, true);
        }

        // Generate SVG QR Code
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($url, $qrPath);

        \App\Models\Table::create([
            'table_number' => $request->table_number,
            'uuid' => $uuid,
            'qr_code_path' => 'qrcodes/' . $qrName,
            'location_lat' => $request->location_lat,
            'location_lng' => $request->location_lng,
            'location_radius' => 100, // Default 100 meter - Prevents neighbor fake orders while tolerating GPS inaccuracy
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

    public function toggleLocation(\App\Models\Table $table)
    {
        // Toggle require_location boolean
        $table->require_location = !$table->require_location;
        $table->save();

        $status = $table->require_location ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->route('tables.index')
                        ->with('success', "Validasi lokasi untuk meja {$table->table_number} berhasil {$status}");
    }
}
