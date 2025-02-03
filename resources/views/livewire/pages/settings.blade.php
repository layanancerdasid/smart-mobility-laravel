<div>
    <!-- Header -->
    <div class="settings-header">
        <div class="d-flex justify-content-between align-items-center px-3 py-2" style="background: #DB0000;">
            <h5 class="text-white m-0">Setting</h5>
            <div class="d-flex align-items-center gap-2">
                <span class="text-white">Hi, Username!</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=002F34&color=fff" alt="Profile"
                    class="rounded-circle" style="width: 32px; height: 32px;">
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="settings-tabs">
        <ul class="nav nav-tabs border-0">
            <li class="nav-item">
                <a class="nav-link active" style="background: #DB0000; color: white; border: none;">
                    General Setting
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="background: #f5f5f5; color: #333; border: none;">
                    Setting
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="background: #f5f5f5; color: #333; border: none;">
                    Camera Management
                </a>
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="settings-content p-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">General Setting</h5>
                <!-- Add your settings form/content here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="settings-footer text-center py-2 text-muted" style="font-size: 12px;">
        © 2000 - Company, Inc. All rights reserved. Address Address
    </div>

    @push('styles')
        <style>
            .settings-header {
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .settings-tabs {
                background: #f5f5f5;
                padding: 0.5rem 1rem 0;
            }

            .nav-tabs {
                border: none;
            }

            .nav-tabs .nav-link {
                border-radius: 8px 8px 0 0;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .nav-tabs .nav-link:not(.active):hover {
                background: #e9ecef;
            }

            .settings-content {
                background: white;
                min-height: calc(100vh - 180px);
            }

            .card {
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .card-title {
                color: #002F34;
                font-weight: 500;
            }

            .settings-footer {
                background: #f5f5f5;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 768px) {
                .nav-tabs .nav-link {
                    padding: 0.5rem 1rem;
                    font-size: 14px;
                }
            }
        </style>
    @endpush
</div>
