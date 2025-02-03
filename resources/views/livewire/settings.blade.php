<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan Sistem</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-tabs {
            border-bottom-color: #DB0000;
        }

        .nav-tabs .nav-link {
            color: #DB0000;
        }

        .nav-tabs .nav-link.active {
            color: white;
            background-color: #DB0000;
            border-color: #DB0000;
        }

        .nav-tabs .nav-link:hover {
            border-color: #DB0000;
            background-color: rgba(219, 0, 0, 0.1);
        }

        .tab-content {
            border: 1px solid #DB0000;
            border-top: none;
        }

        .card-title {
            color: #DB0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 text-center text-danger">Pengaturan Sistem</h2>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting"
                    type="button" role="tab">Pengaturan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="general-setting-tab" data-bs-toggle="tab" data-bs-target="#general-setting"
                    type="button" role="tab">Pengaturan Umum</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="camera-management-tab" data-bs-toggle="tab"
                    data-bs-target="#camera-management" type="button" role="tab">Pengelolaan Kamera</button>
            </li>
        </ul>
        <!-- Tab Contents -->
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="setting" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Pengaturan</h5>
                        <p class="card-text">Selamat datang di halaman pengaturan. Ini adalah konten dari tab
                            Pengaturan.</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="general-setting" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Halaman Pengaturan Umum</h5>
                        <p class="card-text">Ini adalah halaman pengaturan umum dengan informasi detail tentang
                            pengguna.</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-4 overflow-auto" id="camera-management" role="tabpanel"
                style="max-height: 500px;">
                {{-- @include('livewire.cameras') --}}
                <livewire:cameras />

            </div>
        </div>
    </div>
    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
