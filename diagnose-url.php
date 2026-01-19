<?php
// Diagnostic file to check URL configuration
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "<pre>";
echo "=== LARAVEL URL DIAGNOSTIC ===\n\n";

// Check .env file
echo "1. Checking .env file:\n";
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    preg_match('/APP_URL=(.+)/', $envContent, $matches);
    if ($matches) {
        echo "   APP_URL in .env: " . trim($matches[1]) . "\n";
    } else {
        echo "   ❌ APP_URL not found in .env!\n";
    }
} else {
    echo "   ❌ .env file not found!\n";
}

echo "\n2. Checking Laravel config:\n";
echo "   config('app.url'): " . config('app.url') . "\n";
echo "   config('app.env'): " . config('app.env') . "\n";

echo "\n3. Testing route() helper:\n";
$testUuid = '43efbe3f-c246-48b8-ba3c-051dac93de8e';
try {
    $testRoute = route('order.index', $testUuid);
    echo "   route('order.index', uuid): " . $testRoute . "\n";
} catch (\Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
}

echo "\n4. Testing url() helper:\n";
$testUrl = url('/order/' . $testUuid);
echo "   url('/order/uuid'): " . $testUrl . "\n";

echo "\n5. Checking request URL:\n";
echo "   Request URL: " . request()->url() . "\n";
echo "   Request Root: " . request()->root() . "\n";

echo "\n6. Checking config cache:\n";
$configCachePath = __DIR__ . '/bootstrap/cache/config.php';
if (file_exists($configCachePath)) {
    echo "   ⚠️  Config cache exists! This might be using old APP_URL.\n";
    echo "   Cache file: bootstrap/cache/config.php\n";
    
    // Try to read cached APP_URL
    $cachedConfig = include $configCachePath;
    if (isset($cachedConfig['app']['url'])) {
        echo "   Cached APP_URL: " . $cachedConfig['app']['url'] . "\n";
    }
} else {
    echo "   ✅ No config cache found.\n";
}

echo "\n=== RECOMMENDATION ===\n";

$envAppUrl = '';
if (isset($matches[1])) {
    $envAppUrl = trim($matches[1]);
}

$configAppUrl = config('app.url');

if ($envAppUrl !== $configAppUrl) {
    echo "❌ MISMATCH DETECTED!\n";
    echo "   .env APP_URL: $envAppUrl\n";
    echo "   config APP_URL: $configAppUrl\n";
    echo "\n   FIX: Run these commands:\n";
    echo "   1. Clear config cache\n";
    echo "   2. Rebuild config cache\n";
} else if (strpos($configAppUrl, 'localhost') !== false) {
    echo "❌ APP_URL still points to localhost!\n";
    echo "   Current: $configAppUrl\n";
    echo "   Should be: https://satemadurabukitbaru.infinityfreeapp.com\n";
    echo "\n   FIX:\n";
    echo "   1. Edit .env file\n";
    echo "   2. Change APP_URL to https://satemadurabukitbaru.infinityfreeapp.com\n";
    echo "   3. Clear config cache\n";
} else {
    echo "✅ APP_URL configuration looks correct!\n";
    echo "   If QR code still shows localhost, the issue might be:\n";
    echo "   - Old QR code files (delete and regenerate)\n";
    echo "   - Browser cache (clear browser cache)\n";
}

echo "\n⚠️  DELETE THIS FILE NOW for security!\n";
echo "</pre>";
