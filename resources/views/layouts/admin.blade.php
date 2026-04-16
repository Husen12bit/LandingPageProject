<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - SkillBantuin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #1dbf73 0%, #0e8f56 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            z-index: 100;
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-brand h4 {
            color: white;
            margin-bottom: 5px;
        }

        .sidebar-brand small {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: white;
            color: #1dbf73;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #1dbf73;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .menu-toggle {
                display: block;
            }
        }

        .menu-toggle {
            display: none;
            background: #1dbf73;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-handshake"></i> SkillBantuin</h4>
            <small>Admin Panel</small>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('freelancer*') ? 'active' : '' }}" href="{{ route('freelancer.index') }}">
                <i class="fas fa-user"></i> Freelancer
            </a>
            <a class="nav-link {{ request()->routeIs('client*') ? 'active' : '' }}" href="{{ route('client.index') }}">
                <i class="fas fa-building"></i> Client
            </a>
            <a class="nav-link {{ request()->routeIs('kategori*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                <i class="fas fa-tag"></i> Kategori
            </a>
            <a class="nav-link {{ request()->routeIs('project*') ? 'active' : '' }}" href="{{ route('project.index') }}">
                <i class="fas fa-project-diagram"></i> Proyek
            </a>
            <a class="nav-link {{ request()->routeIs('bid*') ? 'active' : '' }}" href="{{ route('bid.index') }}">
                <i class="fas fa-gavel"></i> Penawaran
            </a>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 20px 10px;">
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-globe"></i> Landing Page
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-navbar">
            <div>
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="page-title">@yield('title', 'Dashboard')</span>
            </div>
            <div class="user-info">
                <span class="text-muted">Admin</span>
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar untuk mobile
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
