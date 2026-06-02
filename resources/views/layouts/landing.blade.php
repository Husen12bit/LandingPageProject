{{-- resources/views/layouts/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="SkillBantuin - Platform marketplace freelancer dengan keamanan enterprise & desain super premium.">
    <title>SkillBantuin — Freelance Marketplace of Tomorrow</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* === CUSTOM DESIGN SYSTEM - TEAL & PURPLE PREMIUM === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter Variable', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #020617;
            background-image: radial-gradient(circle at 20% 30%, rgba(124, 58, 237, 0.2) 0%, transparent 50%),
                              radial-gradient(circle at 80% 70%, rgba(20, 184, 166, 0.12) 0%, transparent 55%),
                              radial-gradient(circle at 40% 90%, rgba(52, 211, 153, 0.08) 0%, transparent 60%);
            background-attachment: fixed;
            color: #F8FAFC;
            overflow-x: hidden;
        }

        /* Glassmorphism 2.0 dengan border teal */
        .glass-premium {
            background: rgba(10, 20, 35, 0.45);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(20, 184, 166, 0.25);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }
        .glass-card-premium {
            background: rgba(15, 25, 45, 0.55);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(124, 58, 237, 0.3);
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .glass-card-premium:hover {
            border-color: #14B8A6;
            box-shadow: 0 20px 35px -12px rgba(20, 184, 166, 0.25);
            transform: translateY(-4px);
        }

        /* Trust cards dengan border teal/emerald */
        .trust-card {
            background: rgba(20, 184, 166, 0.08);
            border: 1px solid rgba(20, 184, 166, 0.35);
            backdrop-filter: blur(8px);
        }

        /* Aurora gradient dengan paduan purple & teal */
        @keyframes aurora {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .aurora-bg {
            background: linear-gradient(105deg, #7C3AED 0%, #14B8A6 40%, #34D399 70%, #7C3AED 100%);
            background-size: 300% auto;
            animation: aurora 8s ease infinite;
        }

        /* Scroll progress bar dengan teal */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #7C3AED, #14B8A6, #34D399);
            z-index: 9999;
            transition: width 0.1s ease;
        }

        /* Floating particles dengan warna teal & purple */
        .particle {
            position: fixed;
            pointer-events: none;
            background: rgba(20, 184, 166, 0.4);
            border-radius: 50%;
            filter: blur(2px);
            z-index: 0;
        }

        /* Mouse follower glow (teal dominant) */
        .mouse-glow {
            position: fixed;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(20,184,166,0.15) 0%, rgba(124,58,237,0.08) 60%, transparent 100%);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 0;
            transition: transform 0.05s linear;
        }

        /* Custom scrollbar teal */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #14B8A6; border-radius: 10px; }

        /* Hover effects */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(20, 184, 166, 0.3);
        }

        .active-indicator::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #7C3AED, #14B8A6);
            border-radius: 2px;
        }

        @keyframes float3d {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-18px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .float-3d {
            animation: float3d 5s ease-in-out infinite;
        }

        /* Mobile menu */
        .mobile-menu {
            transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            transform: translateX(100%);
        }
        .mobile-menu.open {
            transform: translateX(0);
        }

        /* Teal glowing button */
        .btn-teal {
            background: linear-gradient(95deg, #14B8A6 0%, #0D9488 100%);
            transition: all 0.2s ease;
        }
        .btn-teal:hover {
            box-shadow: 0 0 20px rgba(20, 184, 166, 0.5);
            transform: scale(1.02);
        }

        /* Status badge tracking */
        .status-badge {
            background: rgba(20, 184, 166, 0.15);
            border-left: 3px solid #14B8A6;
        }
    </style>
    @stack('css')
</head>
<body class="antialiased">

    <div class="scroll-progress" id="scrollProgress"></div>
    <div class="mouse-glow hidden md:block" id="mouseGlow"></div>
    <div id="particlesContainer" style="position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0;"></div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 glass-premium border-b border-teal-500/20 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold bg-gradient-to-r from-purple-400 to-teal-400 bg-clip-text text-transparent tracking-tight">
                SkillBantuin
            </a>
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="/" class="nav-link active-indicator text-white/90 hover:text-teal-400 transition">Beranda</a>
                <a href="/fitur" class="nav-link text-white/70 hover:text-teal-400 transition">Fitur</a>
                <a href="/about" class="nav-link text-white/70 hover:text-teal-400 transition">Tentang</a>
                <a href="/contact" class="nav-link text-white/70 hover:text-teal-400 transition">Pusat Bantuan</a>
            </div>
            <a href="#" class="magnetic-btn px-5 py-2.5 rounded-full btn-teal text-white text-sm font-semibold shadow-lg transition-all">
                <i class="fab fa-google-play mr-2"></i> Download App
            </a>
            <button id="menuBtn" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-3/4 h-full glass-premium backdrop-blur-2xl z-50 p-6 shadow-2xl flex flex-col gap-6 border-l border-teal-500/20">
            <button id="closeMenuBtn" class="self-end text-2xl text-white"><i class="fas fa-times"></i></button>
            <a href="/" class="text-lg font-semibold py-2 border-b border-teal-500/20">Beranda</a>
            <a href="/fitur" class="text-lg font-semibold py-2 border-b border-teal-500/20">Fitur</a>
            <a href="/about" class="text-lg font-semibold py-2 border-b border-teal-500/20">Tentang</a>
            <a href="/contact" class="text-lg font-semibold py-2">Pusat Bantuan</a>
        </div>
    </nav>

    <main class="pt-24 relative z-10">
        @yield('content')
    </main>

    <footer class="border-t border-teal-500/20 py-12 mt-24 relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-gray-400 text-sm">© 2026 SkillBantuin — The Future of Freelance Ecosystem</p>
                <div class="flex gap-6 text-gray-400 text-xl">
                    <i class="fab fa-twitter hover:text-teal-400 cursor-pointer transition"></i>
                    <i class="fab fa-github hover:text-teal-400 cursor-pointer transition"></i>
                    <i class="fab fa-linkedin hover:text-teal-400 cursor-pointer transition"></i>
                    <i class="fab fa-instagram hover:text-teal-400 cursor-pointer transition"></i>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: false, mirror: false, offset: 30 });

        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('scrollProgress').style.width = scrolled + '%';
        });

        const glow = document.getElementById('mouseGlow');
        document.addEventListener('mousemove', (e) => {
            if (glow) {
                glow.style.left = e.clientX + 'px';
                glow.style.top = e.clientY + 'px';
            }
        });

        function createParticles() {
            const container = document.getElementById('particlesContainer');
            for (let i = 0; i < 60; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `floatParticle ${Math.random() * 15 + 8}s infinite ease-in-out`;
                particle.style.opacity = Math.random() * 0.3 + 0.1;
                container.appendChild(particle);
            }
        }
        const styleSheet = document.createElement("style");
        styleSheet.textContent = `@keyframes floatParticle {
            0% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-30px) translateX(20px); }
            100% { transform: translateY(0px) translateX(0px); }
        }`;
        document.head.appendChild(styleSheet);
        createParticles();

        document.querySelectorAll('.magnetic-btn').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate(0px, 0px)';
            });
        });

        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeBtn = document.getElementById('closeMenuBtn');
        if (menuBtn) {
            menuBtn.addEventListener('click', () => mobileMenu.classList.add('open'));
            closeBtn.addEventListener('click', () => mobileMenu.classList.remove('open'));
        }
    </script>
    @stack('js')
</body>
</html>
