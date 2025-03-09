<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Smart Mobility' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/IC_SMART MOBILITY.png') }}" title="Smart Mobility Icon">
    <link rel="apple-touch-icon" href="{{ asset('images/IC_SMART MOBILITY.png') }}" title="Smart Mobility Icon">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/IC_SMART MOBILITY.png') }}"
        title="Smart Mobility Icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl/dist/maplibre-gl.css" />
    <script src="https://unpkg.com/maplibre-gl/dist/maplibre-gl.js"></script>
    <style>
        body {
            background: #f5f5f5;
        }

        .wrapper {
            min-height: 100vh;
            width: 100%;
        }

        .content-wrapper {
            flex: 1;
            width: 100%;
            /* margin-left: 250px;
            transition: all 0.3s ease; */
        }

        .content-wrapper.collapsed {
            /* margin-left: 70px; */
        }

        .main-content {
            min-height: calc(100vh - 80px);
            /* background: #002F34; */
            padding: 1.5rem;
            border-radius: 16px;
            margin: 1rem;
        }

        /* Navbar styles */
        .navbar {
            background: #DB0000;
            padding: 0.75rem 1.5rem;
            width: 100%;
        }

        .navbar .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.5);
        }

        .navbar .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        /* Card styles */
        .card {
            border: none;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .content-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Table styles */
        .table th {
            background: #002F34;
            color: white;
            border: none;
        }

        .table td {
            vertical-align: middle;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #002F34;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #DB0000;
        }

        /* Add map-specific styles */
        .map-content {
            padding: 0 !important;
            overflow: hidden;
        }

        .map-wrapper .content-card {
            padding: 0;
            overflow: hidden;
        }
    </style>

    @livewireStyles

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    @stack('styles')

</head>

<body>
    @if (Auth::check() && !request()->is('login'))
        <div class="wrapper d-flex">
            <livewire:layout.sidebar />
            <div class="content-wrapper">
                <livewire:layout.navbar />
                <main class="main-content {{ request()->routeIs('maps') ? 'map-wrapper' : '' }}">
                    <div class="content-card {{ request()->routeIs('maps') ? 'map-content' : '' }}">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    @else
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            {{ $slot }}
        </div>
    @endif

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Reinitialize icons after Livewire updates
        document.addEventListener('livewire:initialized', () => {
            lucide.createIcons();
        });

        document.addEventListener('livewire:navigated', () => {
            lucide.createIcons();
        });

        // Listen for sidebar toggle events
        Livewire.on('toggle-sidebar', (data) => {
            const contentWrapper = document.querySelector('.content-wrapper');
            if (data.collapsed) {
                contentWrapper.classList.add('collapsed');
            } else {
                contentWrapper.classList.remove('collapsed');
            }
        });

        // Reinitialize icons after any Livewire update
        Livewire.hook('message.processed', (message, component) => {
            lucide.createIcons();
        });
    </script>
    <!-- ... kode lainnya ... -->

    <script>
        window.addEventListener('livewire:init', () => {
            Livewire.on('toggle-sidebar', (event) => {
                console.log('Sidebar collapsed:', event.collapsed);
            });
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>

</html>
