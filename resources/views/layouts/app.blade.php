<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gallery Web</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        /* Theme Colors */
        :root {
            --bg-color: #eff0f3;
            --text-color: #0d0d0d;
            --text-muted: #2a2a2a;
            --btn-color: #ff8e3c;
            --btn-text-color: #0d0d0d;
            --highlight-color: #ff8e3c;
            --secondary-color: #fffffe;
            --tertiary-color: #d9376e;
        }

        /* Full Page Layout */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Content Wrapper */
        .content {
            flex: 1;
        }

        /* Body and Background */
        body {
            background-color: var(--bg-color);
            color: var(--text-muted);
            font-family: 'Roboto', sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--secondary-color);
            padding: 1rem;
            border-bottom: 2px solid var(--highlight-color);
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--text-color);
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: var(--text-muted);
            margin-right: 0.5rem;
            transition: color 0.3s ease-in-out;
            display: flex;
            align-items: center;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: var(--highlight-color);
        }

        .navbar-nav .nav-link i {
            margin-right: 8px;
        }

        /* Flash Message Styling */
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .alert-dismissible .btn-close {
            color: var(--text-color);
        }

        /* Auto-dismiss for Alerts */
        .fade-out {
            opacity: 0;
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--btn-color);
            color: var(--btn-text-color);
            border: none;
            transition: transform 0.3s ease, background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--tertiary-color);
            color: var(--secondary-color);
            transform: scale(1.05);
        }

        /* Footer Styling */
        footer {
            background-color: var(--secondary-color);
            padding: 1rem 0;
            text-align: center;
            color: var(--text-color);
            border-top: 2px solid var(--highlight-color);
        }

        footer a {
            color: var(--text-color);
            margin: 0 10px;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--highlight-color);
        }

        /* Responsive Font Sizes */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-nav .nav-link {
                font-size: 1rem;
            }
        }
    </style>

    <!-- Bootstrap Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script for Auto Dismiss Alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            });
        });
    </script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="https://smkn4bogor.sch.id/assets/images/logo/logoSMKN4.svg" alt="Logo" style="width: 30px;">
                Gallery Web
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                            <i class="fas fa-images"></i> Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('info.index') ? 'active' : '' }}" href="{{ route('info.index') }}">
                            <i class="fas fa-info-circle"></i> Informasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agenda.index') ? 'active' : '' }}" href="{{ route('agenda.index') }}">
                            <i class="fas fa-calendar-alt"></i> Agenda
                        </a>
                    </li>

                    @auth
                    {{-- Link Dashboard khusus untuk Admin --}}
                    @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                    @csrf
                                    <button class="btn btn-link text-decoration-none w-100 text-start">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Flash Message for Success --}}
    <div class="content">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Flash Message for Errors --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} Gallery Web. All rights reserved.</p>
            <div>
                <a href="https://api.whatsapp.com/send/?phone=6282260168886" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp fa-lg"></i></a>
                <a href="https://www.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>
