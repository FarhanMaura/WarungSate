<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sate Ordering')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            padding-bottom: 80px;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Light Mode (Default) */
        body.light-mode {
            background-color: #F5F5F5;
            color: #1A1A1A;
        }

        body.light-mode .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e0e0e0;
        }

        body.light-mode .navbar-brand,
        body.light-mode .btn-light {
            color: #1A1A1A !important;
        }

        body.light-mode .card {
            background-color: white;
            border: 1px solid #e0e0e0;
            color: #1A1A1A;
        }

        body.light-mode .card-title,
        body.light-mode .card-text,
        body.light-mode h1, body.light-mode h2, body.light-mode h3,
        body.light-mode h4, body.light-mode h5, body.light-mode h6,
        body.light-mode p, body.light-mode td, body.light-mode th,
        body.light-mode label, body.light-mode .text-muted {
            color: #1A1A1A !important;
        }

        body.light-mode .table {
            color: #1A1A1A;
        }

        body.light-mode .form-control,
        body.light-mode .form-select {
            background-color: white;
            color: #1A1A1A;
            border: 1px solid #ced4da;
        }

        /* Dark Mode */
        body.dark-mode {
            background-color: #1A1A1A;
            color: #F7F7F7;
        }

        body.dark-mode .navbar {
            background-color: rgba(45, 45, 45, 0.95);
        }

        body.dark-mode .navbar-brand,
        body.dark-mode .btn-light {
            color: #F7F7F7 !important;
        }

        body.dark-mode .card {
            background-color: #2D2D2D;
            border: none;
            color: #F7F7F7;
        }

        body.dark-mode .card-title,
        body.dark-mode .card-text,
        body.dark-mode h1, body.dark-mode h2, body.dark-mode h3,
        body.dark-mode h4, body.dark-mode h5, body.dark-mode h6,
        body.dark-mode p, body.dark-mode td, body.dark-mode th,
        body.dark-mode label {
            color: #F7F7F7 !important;
        }

        body.dark-mode .text-muted {
            color: #B0B0B0 !important;
        }

        body.dark-mode .table {
            color: #F7F7F7;
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #1A1A1A;
            color: #F7F7F7;
            border: 1px solid #444;
        }

        .navbar {
            backdrop-filter: blur(10px);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #ff5252;
        }

        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-color);
            border: none;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        .radius-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            z-index: 9999;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .radius-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        @media print {
            body {
                background: white;
                color: black;
            }
            .no-print {
                display: none !important;
            }
            .navbar, .theme-toggle {
                display: none !important;
            }
        }
    </style>
    @stack('css')
</head>
<body class="light-mode">

    <div id="radius-overlay" class="radius-alert">
        <i class="fas fa-map-marker-alt radius-icon"></i>
        <h2>Out of Range</h2>
        <p>You must be within 30 meters of the restaurant to order.</p>
        <button class="btn btn-outline-light mt-3" onclick="checkLocation()">Try Again</button>
    </div>

    <nav class="navbar navbar-expand-lg fixed-top no-print">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-fire text-danger"></i> Sate Enak
            </a>
            @if(session('cart'))
            <a href="{{ route('order.checkout', request()->route('uuid')) }}" class="btn btn-sm btn-light position-relative">
                <i class="fas fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count(session('cart')) }}
                </span>
            </a>
            @endif
        </div>
    </nav>

    <button class="theme-toggle no-print" onclick="toggleTheme()" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>

    <div class="container mt-5 pt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Theme Toggle
        function toggleTheme() {
            const body = document.body;
            const icon = document.querySelector('#themeToggle i');
            
            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                localStorage.setItem('theme', 'light');
            }
        }

        // Load saved theme
        window.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const body = document.body;
            const icon = document.querySelector('#themeToggle i');
            
            if (savedTheme === 'dark') {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });

        // Store Coordinates
        const STORE_LAT = -6.175392; 
        const STORE_LNG = 106.827153;
        const MAX_RADIUS_METERS = 3000000;

        function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
            var R = 6371;
            var dLat = deg2rad(lat2-lat1);
            var dLon = deg2rad(lon2-lon1); 
            var a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2)
                ; 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            var d = R * c;
            return d * 1000;
        }

        function deg2rad(deg) {
            return deg * (Math.PI/180)
        }

        function checkLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const dist = getDistanceFromLatLonInKm(lat, lng, STORE_LAT, STORE_LNG);
            
            console.log("Distance: " + dist + " meters");

            if (dist > MAX_RADIUS_METERS) {
                document.getElementById('radius-overlay').style.display = 'flex';
            } else {
                document.getElementById('radius-overlay').style.display = 'none';
            }
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation. You must allow location access to order.");
                    document.getElementById('radius-overlay').style.display = 'flex';
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
    @stack('js')
</body>
</html>
