<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Out of Range - Warung Sate</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #FF8C42;
            --secondary-color: #8B4513;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        .icon {
            font-size: 5rem;
            color: var(--primary-color);
            margin-bottom: 30px;
            animation: bounce 2s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }
        
        p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            margin-bottom: 40px;
        }
        
        .btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(139, 69, 19, 0.3);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .info-box {
            background: #fff3e0;
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            margin-top: 30px;
            border-radius: 8px;
            text-align: left;
        }
        
        .info-box strong {
            color: var(--secondary-color);
            display: block;
            margin-bottom: 10px;
        }
        
        .info-box ul {
            margin-left: 20px;
            color: #666;
        }
        
        .info-box li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fas fa-map-marker-alt icon"></i>
        <h1>Di Luar Jangkauan</h1>
        <p>
            Anda harus berada dalam radius <strong>10 meter</strong> dari lokasi Warung Sate Madura Bukit Baru untuk dapat melakukan pemesanan.
        </p>
        <p>
            Silakan datang ke lokasi warung dan scan QR Code yang tersedia di meja.
        </p>
        
        <button onclick="window.location.reload()" class="btn">
            <i class="fas fa-redo"></i> Coba Lagi
        </button>
        
        <div class="info-box">
            <strong><i class="fas fa-info-circle"></i> Informasi:</strong>
            <ul>
                <li>Pastikan GPS/Lokasi di perangkat Anda aktif</li>
                <li>Izinkan akses lokasi saat diminta oleh browser</li>
                <li>Anda harus berada di dalam atau dekat warung</li>
            </ul>
        </div>
    </div>
</body>
</html>
