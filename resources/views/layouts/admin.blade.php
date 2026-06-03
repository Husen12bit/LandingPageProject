{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - SkillBantuin')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Premium Dark Glassmorphism Admin */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter Variable', 'Plus Jakarta Sans', sans-serif;
            background-color: #020617;
            background-image: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.15) 0%, transparent 50%),
                              radial-gradient(circle at 80% 70%, rgba(20, 184, 166, 0.1) 0%, transparent 55%);
            background-attachment: fixed;
            color: #F8FAFC;
        }
        /* Glassmorphism untuk sidebar & card */
        .glass-sidebar {
            background: rgba(11, 17, 32, 0.7);
            backdrop-filter: blur(16px);
            border-right: 1px solid rgba(16, 185, 129, 0.2);
        }
        .glass-card {
            background: rgba(15, 25, 45, 0.55);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(20, 184, 166, 0.25);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            border-color: #10B981;
            box-shadow: 0 10px 25px -10px rgba(16, 185, 129, 0.3);
        }
        .glass-navbar {
            background: rgba(11, 17, 32, 0.6);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(16, 185, 129, 0.2);
        }
        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0B1120; }
        ::-webkit-scrollbar-thumb { background: #10B981; border-radius: 10px; }
        /* Table styles */
        .table-glass {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-glass th {
            background: rgba(20, 184, 166, 0.1);
            color: #14B8A6;
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(16, 185, 129, 0.3);
        }
        .table-glass td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: #E2E8F0;
        }
        .table-glass tr:hover td {
            background: rgba(16, 185, 129, 0.05);
        }
        /* Form controls */
        .input-glass {
            background: rgba(11, 17, 32, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.4);
            border-radius: 10px;
            padding: 10px 14px;
            color: white;
            width: 100%;
            transition: all 0.2s;
        }
        .input-glass:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        }
        .btn-emerald {
            background: linear-gradient(95deg, #10B981, #059669);
            transition: all 0.2s;
        }
        .btn-emerald:hover {
            box-shadow: 0 0 12px rgba(16, 185, 129, 0.5);
            transform: scale(1.02);
        }
        /* Sidebar active link */
        .sidebar-link {
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link.active {
            background: rgba(16, 185, 129, 0.15);
            border-left-color: #10B981;
            color: #10B981;
        }
        .sidebar-link:hover:not(.active) {
            background: rgba(20, 184, 166, 0.1);
            color: #14B8A6;
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR GLASS -->
        <aside class="glass-sidebar w-72 flex-shrink-0 overflow-y-auto z-20 hidden md:block">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-8">
                    <i class="fas fa-handshake text-emerald-400 text-2xl"></i>
                    <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">SkillBantuin</span>
                    <span class="text-xs text-gray-400 ml-auto">Admin</span>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-200">
                        <i class="fas fa-tachometer-alt w-5"></i> Dashboard
                    </a>
                    <a href="{{ route('freelancer.index') }}" class="sidebar-link {{ request()->routeIs('freelancer*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-user w-5"></i> Freelancer
                    </a>
                    <a href="{{ route('client.index') }}" class="sidebar-link {{ request()->routeIs('client*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-building w-5"></i> Client
                    </a>
                    <a href="{{ route('kategori.index') }}" class="sidebar-link {{ request()->routeIs('kategori*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-tag w-5"></i> Kategori
                    </a>
                    <a href="{{ route('project.index') }}" class="sidebar-link {{ request()->routeIs('project*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-project-diagram w-5"></i> Proyek
                    </a>
                    <a href="{{ route('bid.index') }}" class="sidebar-link {{ request()->routeIs('bid*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-gavel w-5"></i> Penawaran
                    </a>
                    <a href="{{ route('user.index') }}" class="sidebar-link {{ request()->routeIs('user*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-users w-5"></i> User
                    </a>
                    <a href="{{ route('transaction.index') }}" class="sidebar-link {{ request()->routeIs('transaction*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-credit-card w-5"></i> Transaksi
                    </a>
                    <a href="{{ route('offer.index') }}" class="sidebar-link {{ request()->routeIs('offer*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-handshake w-5"></i> Offer
                    </a>
                    <hr class="my-4 border-emerald-500/20">
                    <a href="{{ route('home') }}" target="_blank" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">
                        <i class="fas fa-globe w-5"></i> Landing Page
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar Glass -->
            <header class="glass-navbar px-6 py-3 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button id="mobileMenuBtn" class="md:hidden text-white text-xl">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-white/90">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-300 hidden md:inline">
                        <i class="far fa-calendar-alt mr-1"></i> {{ date('d F Y') }}
                    </span>
                    <div class="relative group">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-emerald-400/50 transition">
                            <i class="fas fa-user text-sm text-white"></i>
                        </div>
                        <div class="absolute right-0 top-full pt-1 w-40 opacity-0 invisible pointer-events-none group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <div class="bg-gray-800/90 backdrop-blur-lg rounded-lg shadow-lg overflow-hidden border border-white/10">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-gray-200 hover:bg-emerald-500/20 transition flex items-center gap-2">
                                        <i class="fas fa-sign-out-alt text-emerald-400"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden transition-all"></div>
    <div id="mobileSidebar" class="fixed top-0 left-0 h-full w-72 glass-sidebar z-50 transform -translate-x-full transition-transform duration-300">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-2">
                    <i class="fas fa-handshake text-emerald-400 text-2xl"></i>
                    <span class="text-xl font-bold text-white">SkillBantuin</span>
                </div>
                <button id="closeMobileMenu" class="text-gray-300 text-xl"><i class="fas fa-times"></i></button>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Dashboard</a>
                <a href="{{ route('freelancer.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Freelancer</a>
                <a href="{{ route('client.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Client</a>
                <a href="{{ route('kategori.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Kategori</a>
                <a href="{{ route('project.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Proyek</a>
                <a href="{{ route('bid.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Penawaran</a>
                <a href="{{ route('user.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">User</a>
                <a href="{{ route('transaction.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Transaksi</a>
                <a href="{{ route('offer.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Offer</a>
                <hr class="my-4">
                <a href="{{ route('home') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg">Landing Page</a>
            </nav>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('mobileSidebarOverlay');
        const closeMobile = document.getElementById('closeMobileMenu');

        function openMobileSidebar() {
            mobileSidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }
        function closeMobileSidebar() {
            mobileSidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
        if(mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileSidebar);
        if(closeMobile) closeMobile.addEventListener('click', closeMobileSidebar);
        overlay.addEventListener('click', closeMobileSidebar);
    </script>
    @stack('scripts')
</body>
</html>
