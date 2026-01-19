<?php
/**
 * Export Database LENGKAP dengan CREATE TABLE
 * 
 * Script ini akan export struktur tabel (CREATE TABLE) + data (INSERT)
 * sehingga bisa langsung diimport tanpa migration
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "===========================================\n";
echo "  Export Database LENGKAP (CREATE + DATA)\n";
echo "===========================================\n\n";

$output = "-- ============================================\n";
$output .= "-- Database Export: Warung Sate Madura\n";
$output .= "-- LENGKAP dengan CREATE TABLE + DATA\n";
$output .= "-- Date: " . date('Y-m-d H:i:s') . "\n";
$output .= "-- ============================================\n\n";

$output .= "SET FOREIGN_KEY_CHECKS=0;\n";
$output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$output .= "SET time_zone = \"+00:00\";\n\n";

// Daftar tabel
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
    $output .= "-- Table: $table\n";
    $output .= "-- ============================================\n\n";
    
    // DROP TABLE IF EXISTS
    $output .= "DROP TABLE IF EXISTS `$table`;\n\n";
    
    // GET CREATE TABLE statement
    try {
        $createTable = DB::select("SHOW CREATE TABLE `$table`");
        if (!empty($createTable)) {
            $createStatement = $createTable[0]->{'Create Table'};
            
            // Convert SQLite-specific syntax to MySQL
            $createStatement = str_replace('autoincrement', 'AUTO_INCREMENT', $createStatement);
            
            $output .= $createStatement . ";\n\n";
        }
    } catch (\Exception $e) {
        echo "⚠ Cannot get CREATE TABLE for $table\n";
        // Fallback: create basic structure
        $output .= "-- CREATE TABLE statement not available for $table\n\n";
    }
    
    // Get all rows
    $rows = DB::table($table)->get();
    $rowCount = $rows->count();
    
    if ($rowCount > 0) {
        foreach ($rows as $row) {
            $columns = array_keys((array)$row);
            $values = array_values((array)$row);
            
            // Escape values
            $escapedValues = array_map(function($value) {
                if (is_null($value)) {
                    return 'NULL';
                }
                $value = str_replace(['\\', "'"], ['\\\\', "''"], $value);
                return "'" . $value . "'";
            }, $values);
            
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
$filename = __DIR__ . '/database_export_full.sql';
file_put_contents($filename, $output);

echo "\n===========================================\n";
echo "✓ Export completed successfully!\n";
echo "===========================================\n";
echo "File: database_export_full.sql\n";
echo "Size: " . number_format(filesize($filename)) . " bytes\n";
echo "Tables: $exportedTables\n";
echo "Rows: $totalRows\n";
echo "\n";
echo "File ini sudah include CREATE TABLE!\n";
echo "Bisa langsung diimport tanpa migration.\n";
echo "===========================================\n";
