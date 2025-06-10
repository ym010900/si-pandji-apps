<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Aplikasi Si Pandji')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            width: 240px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 20px 15px;
            z-index: 1050;
            transition: transform 0.3s ease;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 1.3rem;
            cursor: pointer;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: 72px;
            }

            .mobile-header {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 10px 15px;
                border-bottom: 1px solid #dee2e6;
                background-color: #f8f9fa;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 56px;
                z-index: 1001;
            }

            .mobile-header .btn {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
            }

            .mobile-header .app-title {
                font-weight: bold;
                font-size: 1.2rem;
                color: #0d6efd;
            }
        }

        .sidebar .brand-mobile {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar .brand-desktop {
                display: none;
            }
            .sidebar .brand-mobile {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 30px;
            }
            .sidebar .brand-mobile img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }
            .sidebar .brand-mobile span {
                font-weight: bold;
                color: #0d6efd;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Mobile Header -->
    <div class="mobile-header d-md-none">
        <button class="btn btn-link text-dark fs-4" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <div class="w-100 text-center">
            <span class="app-title">TANYA SI PANDJI</span>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar d-md-block">
        <span class="d-md-none close-btn" onclick="toggleSidebar()">&times;</span>

        <h5 class="text-center fw-bold text-primary brand-desktop mb-4">TANYA SI PANDJI</h5>

        <div class="brand-mobile d-md-none">
            <img src="/image/avatar.webp" alt="Si Pandji">
            <span>Si Pandji</span>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/" class="nav-link py-1 px-2">
                    <i class="bi bi-house-door me-2 text-primary"></i>Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="/mood" class="nav-link py-1 px-2">
                    <i class="bi bi-emoji-smile me-2 text-primary"></i>Mood Harian
                </a>
            </li>
            <li class="nav-item">
                <a href="/sentiment" class="nav-link py-1 px-2">
                    <i class="bi bi-graph-up-arrow me-2 text-primary"></i>Analisis Sentimen
                </a>
            </li>
            <li class="nav-item">
                <a href="/chat" class="nav-link py-1 px-2">
                    <i class="bi bi-chat-dots me-2 text-primary"></i>Chatbot
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-grow-1">
        @yield('content')
    </div>

    <footer class="bg-light border-top text-center py-3">
        <div class="container">
            <p class="mb-0 small text-muted">
                &copy; {{ date('Y') }} <strong>Si Pandji DEVS</strong> - Platform Kesehatan Mental untuk Masyarakat Digital.<br>
                Dibuat dengan ❤️ oleh Mereka yang Peduli Kesehatan Jiwa.
            </p>
        </div>
    </footer>

    <!-- Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
