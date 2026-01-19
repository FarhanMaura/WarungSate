<?php
/**
 * Optimize Script untuk InfinityFree
 * 
 * File ini akan di-upload ke htdocs/ dan diakses via browser
 * untuk optimize Laravel cache di server production
 * 
 * PENTING: HAPUS FILE INI SETELAH OPTIMIZE SELESAI!
 */

echo "<!DOCTYPE html>
<html>
<head>
    <title>Laravel Optimize - Warung Sate</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; border-bottom: 3px solid #FF8C42; padding-bottom: 10px; }
        .success { color: #28a745; background: #d4edda; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .warning { color: #856404; background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
<div class='container'>
<h1>⚡ Laravel Optimize - Warung Sate Madura</h1>";

try {
    echo "<div class='info'>📦 Loading Laravel...</div>";
    
    // Load Laravel
    require __DIR__.'/../private_html/vendor/autoload.php';
    $app = require_once __DIR__.'/../private_html/bootstrap/app.php';
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    $kernel->bootstrap();
    
    echo "<div class='success'>✓ Laravel loaded successfully</div>";
    
    // Clear all caches
    echo "<div class='info'>🧹 Clearing all caches...</div>";
    
    $commands = [
        'config:clear' => 'Configuration cache',
        'cache:clear' => 'Application cache',
        'view:clear' => 'View cache',
        'route:clear' => 'Route cache',
    ];
    
    foreach ($commands as $command => $description) {
        echo "<div class='info'>Clearing $description...</div>";
        ob_start();
        $kernel->call($command);
        $output = ob_get_clean();
        echo "<div class='success'>✓ $description cleared</div>";
    }
    
    // Cache config and routes for production
    echo "<div class='info'>💾 Caching for production...</div>";
    
    $cacheCommands = [
        'config:cache' => 'Configuration',
        'route:cache' => 'Routes',
        'view:cache' => 'Views',
    ];
    
    foreach ($cacheCommands as $command => $description) {
        echo "<div class='info'>Caching $description...</div>";
        ob_start();
        $kernel->call($command);
        $output = ob_get_clean();
        echo "<div class='success'>✓ $description cached</div>";
        if (!empty($output)) {
            echo "<pre>$output</pre>";
        }
    }
    
    // Show cache info
    echo "<div class='info'>📊 Cache Information:</div>";
    echo "<pre>";
    
    $cacheFiles = [
        'Config' => __DIR__.'/../private_html/bootstrap/cache/config.php',
        'Routes' => __DIR__.'/../private_html/bootstrap/cache/routes-v7.php',
    ];
    
    foreach ($cacheFiles as $name => $file) {
        if (file_exists($file)) {
            $size = filesize($file);
            $modified = date('Y-m-d H:i:s', filemtime($file));
            echo "$name cache: " . number_format($size) . " bytes (modified: $modified)\n";
        } else {
            echo "$name cache: Not found\n";
        }
    }
    
    echo "</pre>";
    
    echo "<div class='success'><strong>✓ Optimization completed successfully!</strong></div>";
    
    echo "<div class='info'>
        <strong>✓ Aplikasi sudah dioptimasi!</strong><br>
        Cache config, routes, dan views sudah dibuat untuk performa maksimal.
    </div>";
    
    echo "<div class='warning'>
        <strong>⚠️ PENTING - LANGKAH TERAKHIR:</strong><br>
        1. <strong>HAPUS file ini (optimize.php)</strong> untuk keamanan<br>
        2. Test aplikasi di browser<br>
        3. Jika ada perubahan di .env atau routes, jalankan script ini lagi<br>
        4. Untuk clear cache saja tanpa rebuild, akses <code>clear-cache.php</code> (jika ada)
    </div>";
    
    echo "<div class='info'>
        <strong>📝 Catatan:</strong><br>
        - Setiap kali update .env, jalankan script ini lagi<br>
        - Setiap kali update routes, jalankan script ini lagi<br>
        - Jika aplikasi error setelah optimize, clear cache terlebih dahulu
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
        1. Pastikan Laravel sudah terinstall dengan benar<br>
        2. Cek permission folder bootstrap/cache/ = 777<br>
        3. Cek permission folder storage/ = 777<br>
        4. Pastikan .env file ada dan valid
    </div>";
}

echo "</div></body></html>";
