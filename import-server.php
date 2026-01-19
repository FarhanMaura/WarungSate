<?php
/**
 * Import Data Script untuk InfinityFree
 * 
 * File ini akan di-upload ke htdocs/ dan diakses via browser
 * untuk import data dari database_export.sql ke MySQL
 * 
 * PENTING: HAPUS FILE INI SETELAH IMPORT SELESAI!
 */

echo "<!DOCTYPE html>
<html>
<head>
    <title>Data Import - Warung Sate</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; border-bottom: 3px solid #FF8C42; padding-bottom: 10px; }
        .success { color: #28a745; background: #d4edda; padding: 8px 12px; border-radius: 5px; margin: 5px 0; font-size: 14px; }
        .error { color: #dc3545; background: #f8d7da; padding: 8px 12px; border-radius: 5px; margin: 5px 0; font-size: 14px; }
        .info { color: #0c5460; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .warning { color: #856404; background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107; }
        .progress { background: #e9ecef; border-radius: 5px; overflow: hidden; margin: 10px 0; }
        .progress-bar { background: #28a745; color: white; padding: 5px; text-align: center; transition: width 0.3s; }
        pre { background: #f8f9fa; padding: 10px; border-radius: 5px; max-height: 300px; overflow-y: auto; font-size: 12px; }
    </style>
</head>
<body>
<div class='container'>
<h1>📥 Import Data - Warung Sate Madura</h1>";

try {
    echo "<div class='info'>📦 Loading Laravel...</div>";
    
    // Load Laravel
    require __DIR__.'/../private_html/vendor/autoload.php';
    $app = require_once __DIR__.'/../private_html/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    use Illuminate\Support\Facades\DB;
    
    echo "<div class='success'>✓ Laravel loaded</div>";
    
    // Check SQL file
    $sqlFile = __DIR__.'/../private_html/database_export.sql';
    
    if (!file_exists($sqlFile)) {
        throw new Exception("File database_export.sql tidak ditemukan di private_html/");
    }
    
    $fileSize = filesize($sqlFile);
    echo "<div class='success'>✓ Found SQL file: " . number_format($fileSize) . " bytes</div>";
    
    // Read SQL file
    echo "<div class='info'>📖 Reading SQL file...</div>";
    $sql = file_get_contents($sqlFile);
    
    // Split statements
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) {
            return !empty($stmt) && 
                   strpos($stmt, '--') !== 0 && 
                   strpos($stmt, 'SET') !== 0;
        }
    );
    
    $totalStatements = count($statements);
    echo "<div class='success'>✓ Found $totalStatements SQL statements</div>";
    
    // Execute statements
    echo "<div class='info'>⚙️ Executing SQL statements...</div>";
    echo "<div class='progress'><div class='progress-bar' id='progress' style='width: 0%'>0%</div></div>";
    echo "<div id='log' style='max-height: 400px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 5px; margin: 10px 0;'>";
    
    flush();
    ob_flush();
    
    $executed = 0;
    $errors = 0;
    $inserted = 0;
    
    foreach ($statements as $index => $statement) {
        try {
            DB::statement($statement);
            
            // Count inserts
            if (stripos($statement, 'INSERT INTO') === 0) {
                $inserted++;
            }
            
            $executed++;
            
            // Show progress every 10 statements
            if ($executed % 10 === 0 || $executed === $totalStatements) {
                $percent = round(($executed / $totalStatements) * 100);
                echo "<script>
                    document.getElementById('progress').style.width = '$percent%';
                    document.getElementById('progress').textContent = '$percent%';
                </script>";
                flush();
                ob_flush();
            }
            
            // Log first 50 characters of statement
            $preview = substr($statement, 0, 50);
            echo "<div class='success' style='font-size: 11px; padding: 3px 8px;'>✓ " . htmlspecialchars($preview) . "...</div>";
            
            if ($executed % 5 === 0) {
                flush();
                ob_flush();
            }
            
        } catch (\Exception $e) {
            $errors++;
            $preview = substr($statement, 0, 50);
            echo "<div class='error' style='font-size: 11px; padding: 3px 8px;'>✗ " . htmlspecialchars($preview) . "... - " . htmlspecialchars($e->getMessage()) . "</div>";
            flush();
            ob_flush();
        }
    }
    
    echo "</div>";
    
    // Summary
    echo "<div class='info'>";
    echo "<strong>📊 Import Summary:</strong><br>";
    echo "Total statements: $totalStatements<br>";
    echo "Executed successfully: $executed<br>";
    echo "Insert statements: $inserted<br>";
    echo "Errors: $errors<br>";
    echo "</div>";
    
    // Show table counts
    echo "<div class='info'>📋 Database tables after import:</div>";
    echo "<pre>";
    
    $tables = ['users', 'menus', 'tables', 'payment_methods', 'orders', 'order_items'];
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "- $table: $count rows\n";
        } catch (\Exception $e) {
            echo "- $table: Error - " . $e->getMessage() . "\n";
        }
    }
    echo "</pre>";
    
    if ($errors === 0) {
        echo "<div class='success'><strong>✓ Import completed successfully!</strong></div>";
    } else {
        echo "<div class='warning'><strong>⚠ Import completed with $errors errors</strong></div>";
    }
    
    echo "<div class='warning'>
        <strong>⚠️ PENTING - LANGKAH SELANJUTNYA:</strong><br>
        1. Verifikasi data sudah masuk dengan benar<br>
        2. Test login ke aplikasi<br>
        3. <strong>HAPUS file ini (import.php)</strong> untuk keamanan<br>
        4. Hapus juga file <code>database_export.sql</code> dari server<br>
        5. Jalankan <code>optimize.php</code> untuk optimize cache
    </div>";
    
} catch (\Exception $e) {
    echo "<div class='error'>";
    echo "<strong>❌ Error:</strong><br>";
    echo htmlspecialchars($e->getMessage());
    echo "</div>";
    
    echo "<div class='info'><strong>Stack Trace:</strong></div>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    
    echo "<div class='warning'>
        <strong>Troubleshooting:</strong><br>
        1. Pastikan migration sudah dijalankan terlebih dahulu<br>
        2. Pastikan file database_export.sql ada di private_html/<br>
        3. Cek koneksi database di .env<br>
        4. Pastikan tabel sudah dibuat (run migrate.php dulu)
    </div>";
}

echo "</div></body></html>";
