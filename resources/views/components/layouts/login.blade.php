<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Mobility - Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background-image: linear-gradient(135deg, #000000 0%, #c444441a 50%, #5c0000 100%), url('https://images.unsplash.com/photo-1518770660439-4636190af475?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1920'); */
            background-image: linear-gradient(135deg, #000000 0%, #c444441a 50%, #5c0000 100%), url('../images/bg.png');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
        }

        .corner-logo {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .corner-logo img {
            height: 40px;
            width: auto;
        }

        .login-card {
            background: transparent;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3.5rem;
            box-shadow: 0 8px 32px rgba(255, 255, 255, 0.192);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 800px;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #DB0000;
            box-shadow: 0 0 15px rgba(219, 0, 0, 0.3);
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn {
            padding: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .btn-danger {
            background: linear-gradient(45deg, #DB0000, #FF1A1A);
            border: none;
            box-shadow: 0 4px 15px rgba(219, 0, 0, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #FF1A1A, #DB0000);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(219, 0, 0, 0.4);
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #00c6ff);
            border: none;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #00c6ff, #007bff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        }

        .brand-text {
            color: #ffffff;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 3px;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        /* Tambahkan animasi loading pada tombol saat submit */
        .btn[type="submit"] {
            position: relative;
            overflow: hidden;
        }

        .btn[type="submit"]::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            100% {
                left: 100%;
            }
        }

        /* Alert styling */
        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
            background: rgba(220, 53, 69, 0.2);
            backdrop-filter: blur(5px);
            color: #fff;
            border-left: 4px solid #dc3545;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .login-card {
                padding: 2.5rem;
                margin: 1rem;
                max-width: 90%;
            }

            .corner-logo {
                top: 10px;
                left: 10px;
            }

            .corner-logo img {
                height: 30px;
            }

            .brand-text {
                font-size: 1.8rem;
            }

            .form-control,
            .btn {
                padding: 0.6rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }

            .brand-text {
                font-size: 1.5rem;
            }

            .corner-logo img {
                height: 25px;
            }
        }

        .card-body {
            max-width: 700px;
            margin: 0 auto;
        }

        .corner-logo a {
            display: block;
            text-decoration: none;
        }

        .corner-logo a:hover {
            opacity: 0.9;
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div>
        <!-- Logo di pojok kiri -->
        <div class="corner-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/IC_SMART MOBILITY.png') }}" alt="Smart Mobility Logo">
            </a>
        </div>

        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="login-card ">
                <div class="card-body">
                    <h3 class="brand-text">LOG IN</h3>

                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form wire:submit="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" wire:model.live="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" wire:model.live="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Login</button>
                        <button type="button" class="btn btn-primary w-100 mt-2"
                            onclick="window.location='{{ route('sso.login') }}'">Login with SSO</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
