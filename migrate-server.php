<?php
/**
 * Migration Script untuk InfinityFree
 * 
 * File ini akan di-upload ke htdocs/ dan diakses via browser
 * untuk menjalankan migration Laravel di server
 * 
 * PENTING: HAPUS FILE INI SETELAH MIGRATION SELESAI!
 */

// Prevent direct access from non-localhost (optional security)
// Uncomment jika ingin hanya bisa diakses sekali
// if (file_exists(__DIR__ . '/migration_done.lock')) {
//     die('Migration already completed. Delete migration_done.lock to run again.');
// }

echo "<!DOCTYPE html>
<html>
<head>
    <title>Laravel Migration - Warung Sate</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; border-bottom: 3px solid #FF8C42; padding-bottom: 10px; }
        .success { color: #28a745; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .warning { color: #856404; background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
<div class='container'>
<h1>🚀 Laravel Migration - Warung Sate Madura</h1>";

try {
    echo "<div class='info'>📦 Loading Laravel...</div>";
    
    // Load Laravel
    require __DIR__.'/../private_html/vendor/autoload.php';
    $app = require_once __DIR__.'/../private_html/bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    $kernel->bootstrap();
    
    echo "<div class='success'>✓ Laravel loaded successfully</div>";
    
    // Test database connection
    echo "<div class='info'>🔌 Testing database connection...</div>";
    
    use Illuminate\Support\Facades\DB;
    $connection = DB::connection()->getPdo();
    $dbName = DB::connection()->getDatabaseName();
    
    echo "<div class='success'>✓ Connected to database: <strong>$dbName</strong></div>";
    
    // Run migrations
    echo "<div class='info'>🔄 Running migrations...</div>";
    
    ob_start();
    $status = $kernel->call('migrate', [
        '--force' => true,
        '--no-interaction' => true
    ]);
    $output = ob_get_clean();
    
    echo "<pre>$output</pre>";
    
    if ($status === 0) {
        echo "<div class='success'>✓ Migrations completed successfully!</div>";
    } else {
        echo "<div class='error'>⚠ Migration completed with status: $status</div>";
    }
    
    // Clear caches
    echo "<div class='info'>🧹 Clearing caches...</div>";
    
    $kernel->call('config:clear');
    $kernel->call('cache:clear');
    $kernel->call('view:clear');
    $kernel->call('route:clear');
    
    echo "<div class='success'>✓ Caches cleared</div>";
    
    // Show tables
    echo "<div class='info'>📋 Database tables:</div>";
    $tables = DB::select('SHOW TABLES');
    echo "<pre>";
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        $count = DB::table($tableName)->count();
        echo "- $tableName ($count rows)\n";
    }
    echo "</pre>";
    
    // Create lock file
    // file_put_contents(__DIR__ . '/migration_done.lock', date('Y-m-d H:i:s'));
    
    echo "<div class='warning'>
        <strong>⚠️ PENTING - LANGKAH SELANJUTNYA:</strong><br>
        1. Migration berhasil! Sekarang import data via <code>import.php</code><br>
        2. Setelah selesai, <strong>HAPUS file ini (migrate.php)</strong> untuk keamanan<br>
        3. Jangan lupa hapus juga <code>import.php</code> dan <code>optimize.php</code> setelah digunakan
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
        1. Pastikan file .env sudah ada di private_html/<br>
        2. Cek kredensial database di .env sudah benar<br>
        3. Pastikan database sudah dibuat di Control Panel<br>
        4. Cek permission folder storage/ dan bootstrap/cache/ = 777
    </div>";
}

echo "</div></body></html>";
