{{-- resources/views/layouts/landing.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="SkillBantuin - Platform marketplace freelancer dengan standar keamanan enterprise & desain super premium.">
    <title>SkillBantuin — Freelance Marketplace of Tomorrow</title>

    <!-- Google Fonts: Inter Variable + Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN + basic customization -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome 6 (free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* === CUSTOM DESIGN SYSTEM === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter Variable', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #020617;
            background-image: radial-gradient(circle at 25% 10%, rgba(124, 58, 237, 0.2) 0%, transparent 50%),
                              radial-gradient(circle at 85% 80%, rgba(249, 115, 22, 0.15) 0%, transparent 55%),
                              radial-gradient(circle at 50% 50%, rgba(6, 182, 212, 0.08) 0%, transparent 70%);
            background-attachment: fixed;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* Glassmorphism 2.0 */
        .glass-premium {
            background: rgba(10, 20, 30, 0.45);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(124, 58, 237, 0.25);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }
        .glass-card-premium {
            background: rgba(15, 25, 40, 0.55);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(124, 58, 237, 0.3);
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .glass-card-premium:hover {
            border-color: #F97316;
            box-shadow: 0 20px 35px -12px rgba(124, 58, 237, 0.3);
            transform: translateY(-4px);
        }

        /* Magnetic Button */
        .magnetic-btn {
            transition: transform 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Aurora gradient animations */
        @keyframes aurora {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .aurora-bg {
            background: linear-gradient(105deg, #7C3AED 0%, #F97316 40%, #06B6D4 70%, #7C3AED 100%);
            background-size: 300% auto;
            animation: aurora 8s ease infinite;
        }

        /* Scroll progress bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #7C3AED, #F97316, #06B6D4);
            z-index: 9999;
            transition: width 0.1s ease;
        }

        /* Floating particles */
        .particle {
            position: fixed;
            pointer-events: none;
            background: rgba(124, 58, 237, 0.4);
            border-radius: 50%;
            filter: blur(2px);
            z-index: 0;
        }

        /* Mouse follower glow */
        .mouse-glow {
            position: fixed;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(124,58,237,0.2) 0%, rgba(249,115,22,0.05) 70%, transparent 100%);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 0;
            transition: transform 0.05s linear;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #7C3AED; border-radius: 10px; }

        /* Animation delays & utilities */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0,0,0,0.3);
        }
        .active-indicator {
            position: relative;
        }
        .active-indicator::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #7C3AED, #F97316);
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
    </style>
    @stack('css')
</head>
<body class="antialiased">

    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Mouse follower glow -->
    <div class="mouse-glow hidden md:block" id="mouseGlow"></div>

    <!-- Floating particles generator (JS will populate) -->
    <div id="particlesContainer" style="position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0;"></div>

    <!-- Navbar Glass + Magnetic + Active Indicator -->
    <nav class="fixed top-0 left-0 w-full z-50 glass-premium border-b border-white/10 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold bg-gradient-to-r from-purple-400 to-orange-400 bg-clip-text text-transparent tracking-tight">
                SkillBantuin
            </a>
            <!-- Desktop menu -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="/" class="nav-link active-indicator text-white/90 hover:text-purple-400 transition">Beranda</a>
                <a href="/fitur" class="nav-link text-white/70 hover:text-purple-400 transition">Fitur</a>
                <a href="/about" class="nav-link text-white/70 hover:text-purple-400 transition">Tentang</a>
                <a href="/contact" class="nav-link text-white/70 hover:text-purple-400 transition">Pusat Bantuan</a>
            </div>
            <!-- Magnetic Download Button -->
            <a href="#" class="magnetic-btn px-5 py-2.5 rounded-full bg-gradient-to-r from-purple-600 to-orange-500 text-white text-sm font-semibold shadow-lg hover:shadow-purple-500/30 transition-all">
                <i class="fab fa-google-play mr-2"></i> Download App
            </a>
            <!-- Mobile hamburger -->
            <button id="menuBtn" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <!-- Mobile Off-Canvas Menu -->
        <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 w-3/4 h-full glass-premium backdrop-blur-2xl z-50 p-6 shadow-2xl flex flex-col gap-6 border-l border-white/20">
            <button id="closeMenuBtn" class="self-end text-2xl text-white"><i class="fas fa-times"></i></button>
            <a href="/" class="text-lg font-semibold py-2 border-b border-white/10">Beranda</a>
            <a href="/fitur" class="text-lg font-semibold py-2 border-b border-white/10">Fitur</a>
            <a href="/about" class="text-lg font-semibold py-2 border-b border-white/10">Tentang</a>
            <a href="/contact" class="text-lg font-semibold py-2">Pusat Bantuan</a>
        </div>
    </nav>

    <main class="pt-24 relative z-10">
        @yield('content')
    </main>

    <!-- Footer premium -->
    <footer class="border-t border-white/10 py-12 mt-24 relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-gray-400 text-sm">© 2026 SkillBantuin — The Future of Freelance Ecosystem</p>
                <div class="flex gap-6 text-gray-400 text-xl">
                    <i class="fab fa-twitter hover:text-purple-400 cursor-pointer transition"></i>
                    <i class="fab fa-github hover:text-purple-400 cursor-pointer transition"></i>
                    <i class="fab fa-linkedin hover:text-purple-400 cursor-pointer transition"></i>
                    <i class="fab fa-instagram hover:text-purple-400 cursor-pointer transition"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({ duration: 700, once: false, mirror: false, offset: 30 });

        // Scroll Progress
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('scrollProgress').style.width = scrolled + '%';
        });

        // Mouse follower glow
        const glow = document.getElementById('mouseGlow');
        document.addEventListener('mousemove', (e) => {
            if (glow) {
                glow.style.left = e.clientX + 'px';
                glow.style.top = e.clientY + 'px';
            }
        });

        // Floating particles
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

        // Magnetic buttons effect
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

        // Mobile menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeBtn = document.getElementById('closeMenuBtn');
        if (menuBtn) {
            menuBtn.addEventListener('click', () => mobileMenu.classList.add('open'));
            closeBtn.addEventListener('click', () => mobileMenu.classList.remove('open'));
        }

        // Active nav indicator update on scroll (simple)
        const sections = ['/', '/fitur', '/tentang', '/bantuan'];
        // just for style, not dynamic path; we rely on current url
    </script>
    @stack('js')
</body>
</html>
