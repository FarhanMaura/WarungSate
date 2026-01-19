<?php
/**
 * Export Database dari SQLite ke MySQL Format
 * 
 * Script ini akan membaca semua data dari database SQLite lokal
 * dan menghasilkan file SQL yang kompatibel dengan MySQL
 * untuk di-import ke InfinityFree
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "===========================================\n";
echo "  Export Database SQLite to MySQL\n";
echo "===========================================\n\n";

$output = "-- ============================================\n";
$output .= "-- Database Export: Warung Sate Madura\n";
$output .= "-- From: SQLite (Local)\n";
$output .= "-- To: MySQL (InfinityFree)\n";
$output .= "-- Date: " . date('Y-m-d H:i:s') . "\n";
$output .= "-- ============================================\n\n";

$output .= "SET FOREIGN_KEY_CHECKS=0;\n";
$output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$output .= "SET time_zone = \"+00:00\";\n\n";

// Daftar tabel yang akan di-export (urutan penting untuk foreign keys)
$tables = [
    'users',
    'password_reset_tokens',
    'sessions',
    'cache',
    'cache_locks',
    'jobs',
    'job_batches',
    'failed_jobs',
    'menus',
    'tables',
    'payment_methods',
    'orders',
    'order_items'
];

$totalRows = 0;
$exportedTables = 0;

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        echo "⚠ Table '$table' not found, skipping...\n";
        continue;
    }
    
    echo "📋 Exporting table: $table ... ";
    
    $output .= "-- ============================================\n";
    $output .= "-- Table structure and data for: $table\n";
    $output .= "-- ============================================\n\n";
    
    // Truncate table first (clear existing data)
    $output .= "TRUNCATE TABLE `$table`;\n\n";
    
    // Get all rows
    $rows = DB::table($table)->get();
    $rowCount = $rows->count();
    
    if ($rowCount > 0) {
        foreach ($rows as $row) {
            $columns = array_keys((array)$row);
            $values = array_values((array)$row);
            
            // Escape values untuk MySQL
            $escapedValues = array_map(function($value) {
                if (is_null($value)) {
                    return 'NULL';
                }
                // Escape single quotes dan backslashes
                $value = str_replace(['\\', "'"], ['\\\\', "''"], $value);
                return "'" . $value . "'";
            }, $values);
            
            // Build INSERT statement
            $columnList = '`' . implode('`, `', $columns) . '`';
            $valueList = implode(', ', $escapedValues);
            
            $output .= "INSERT INTO `$table` ($columnList) VALUES ($valueList);\n";
        }
        
        $output .= "\n";
        $totalRows += $rowCount;
        echo "✓ $rowCount rows\n";
    } else {
        echo "⚠ Empty table\n";
    }
    
    $exportedTables++;
}

$output .= "SET FOREIGN_KEY_CHECKS=1;\n\n";
$output .= "-- ============================================\n";
$output .= "-- Export Summary\n";
$output .= "-- Tables exported: $exportedTables\n";
$output .= "-- Total rows: $totalRows\n";
$output .= "-- ============================================\n";

// Save to file
$filename = __DIR__ . '/database_export.sql';
file_put_contents($filename, $output);

echo "\n===========================================\n";
echo "✓ Export completed successfully!\n";
echo "===========================================\n";
echo "File: database_export.sql\n";
echo "Size: " . number_format(filesize($filename)) . " bytes\n";
echo "Tables: $exportedTables\n";
echo "Rows: $totalRows\n";
echo "\n";
echo "Next steps:\n";
echo "1. Upload file ini ke InfinityFree\n";
echo "2. Import via phpMyAdmin atau script import.php\n";
echo "===========================================\n";
