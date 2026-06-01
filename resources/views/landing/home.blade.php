@extends('layouts.landing')

@section('content')
<div class="container mx-auto px-6 relative z-10">
    <!-- Hero Section : Massive Headline + Floating 3D Mockup + Aurora effect -->
    <div class="flex flex-col lg:flex-row items-center justify-between min-h-[85vh] gap-12 py-10">
        <div class="flex-1 text-center lg:text-left" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex items-center gap-2 bg-purple-500/20 backdrop-blur-sm rounded-full px-4 py-1.5 border border-purple-400/30 mb-6">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-medium tracking-wide">#1 Freelance Marketplace in Southeast Asia</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight tracking-tight">
                <span class="bg-gradient-to-r from-white via-purple-200 to-orange-200 bg-clip-text text-transparent">Unlock Top Talent,</span><br>
                <span class="bg-gradient-to-r from-purple-400 via-orange-400 to-cyan-400 bg-clip-text text-transparent">One Tap Away</span>
            </h1>
            <p class="text-gray-300 text-lg max-w-xl mx-auto lg:mx-0 mt-6 leading-relaxed">
                SkillBantuin connects you with vetted freelancers, real-time project tracking, and bank-grade escrow payments.
            </p>
            <div class="mt-8 flex flex-wrap gap-4 justify-center lg:justify-start">
                <a href="#" class="magnetic-btn px-8 py-3.5 rounded-full bg-gradient-to-r from-purple-600 to-purple-700 text-white font-semibold shadow-xl hover:shadow-purple-500/40 transition-all">
                    <i class="fab fa-apple text-xl mr-2"></i> App Store
                </a>
                <a href="#" class="magnetic-btn px-8 py-3.5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold shadow-xl hover:shadow-orange-500/40 transition-all">
                    <i class="fab fa-google-play text-xl mr-2"></i> Google Play
                </a>
            </div>
            <!-- Trust badges & Animated Statistics -->
            <div class="mt-10 flex flex-wrap gap-8 justify-center lg:justify-start text-sm">
                <div class="flex items-center gap-2"><i class="fas fa-check-circle text-purple-400"></i> <span>100% Verifikasi</span></div>
                <div class="flex items-center gap-2"><i class="fas fa-lock text-orange-400"></i> <span>Escrow Aman</span></div>
                <div class="flex items-center gap-2"><i class="fas fa-headset text-cyan-400"></i> <span>Support 24/7</span></div>
            </div>
            <div class="mt-8 flex gap-8 justify-center lg:justify-start" id="statCounter">
                <div><span class="stat-number text-2xl font-bold text-purple-400" data-target="25000">0</span><span class="text-sm text-gray-300">+ Freelancer</span></div>
                <div><span class="stat-number text-2xl font-bold text-orange-400" data-target="8450">0</span><span class="text-sm text-gray-300">Proyek Selesai</span></div>
                <div><span class="stat-number text-2xl font-bold text-cyan-400" data-target="98">0</span><span class="text-sm text-gray-300">% Kepuasan</span></div>
            </div>
        </div>
        <div class="flex-1 flex justify-center relative" data-aos="fade-left" data-aos-delay="200">
            <div class="relative w-72 h-[550px] rounded-[2rem] border-2 border-purple-500/40 shadow-2xl overflow-hidden bg-gradient-to-b from-purple-900/30 to-slate-900/80 backdrop-blur-sm float-3d">
                <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                    <img src="{{ asset('images/app02.png') }}" alt="Logo">
                </div>
            </div>
            <!-- Ambient lighting behind -->
            <div class="absolute -z-10 w-80 h-80 bg-purple-600/30 rounded-full blur-3xl top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
        </div>
    </div>

    <!-- Bento Grid Features (preview) - full bento di halaman fitur, tapi disini kita tampilkan 3 highlight -->
    <div class="my-32 grid md:grid-cols-3 gap-6" data-aos="fade-up">
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-bolt text-3xl text-purple-400"></i>
            <h3 class="text-xl font-bold mt-3">Instant Match</h3>
            <p class="text-gray-300 text-sm mt-2">AI-powered recommendation in seconds</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-chart-line text-3xl text-orange-400"></i>
            <h3 class="text-xl font-bold mt-3">Live Tracking</h3>
            <p class="text-gray-300 text-sm mt-2">Real-time milestone updates</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-shield-alt text-3xl text-cyan-400"></i>
            <h3 class="text-xl font-bold mt-3">Secure Escrow</h3>
            <p class="text-gray-300 text-sm mt-2">Payment released upon approval</p>
        </div>
    </div>

    <!-- Testimonials Auto Carousel -->
    <div class="my-32" data-aos="zoom-in">
        <h2 class="text-4xl font-bold text-center mb-12 bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">Trusted by 8,000+ businesses</h2>
        <div class="relative max-w-4xl mx-auto overflow-hidden" id="testimonialCarousel">
            <div class="flex transition-transform duration-500 ease-out" id="carouselTrack">
                @php
                    $testimonials = [
                        ['name'=>'Budi Santoso', 'role'=>'CEO Edukita', 'text'=>'SkillBantuin mempercepat hiring kami 3x lipat. Kualitas freelancer luar biasa!', 'rating'=>5, 'avatar'=>'B'],
                        ['name'=>'Dewi Lestari', 'role'=>'Founder BatikIndo', 'text'=>'Sistem escrow memberikan rasa aman. Proyek selesai tepat waktu.', 'rating'=>5, 'avatar'=>'D'],
                        ['name'=>'Agus Wijaya', 'role'=>'CTO TechHub', 'text'=>'UI/UX sangat modern dan mudah digunakan. Tim support responsif.', 'rating'=>5, 'avatar'=>'A'],
                        ['name'=>'Sari Mulyani', 'role'=>'Product Lead', 'text'=>'Fitur track project bikin transparansi level atas.', 'rating'=>5, 'avatar'=>'S']
                    ];
                @endphp
                @foreach($testimonials as $t)
                <div class="w-full flex-shrink-0 px-4">
                    <div class="glass-card-premium p-8 rounded-2xl text-center">
                        <div class="flex justify-center gap-1 text-yellow-400 mb-3">{!! str_repeat('<i class="fas fa-star"></i>', $t['rating']) !!}</div>
                        <p class="text-gray-200 italic text-lg">“{{ $t['text'] }}”</p>
                        <div class="flex justify-center items-center gap-3 mt-6">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-orange-400 flex items-center justify-center text-white font-bold">{{ $t['avatar'] }}</div>
                            <div class="text-left">
                                <h4 class="font-bold">{{ $t['name'] }}</h4>
                                <p class="text-xs text-gray-400">{{ $t['role'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button id="prevTesti" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white"><i class="fas fa-chevron-left"></i></button>
            <button id="nextTesti" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- FAQ Accordion (smooth height animation) -->
    <div class="max-w-3xl mx-auto my-32" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-10">Frequently Asked Questions</h2>
        <div class="space-y-4" id="faqAccordion">
            @php $faqs = [
                ['q'=>'Bagaimana verifikasi freelancer?', 'a'=>'Setiap freelancer melalui pemeriksaan ID, portofolio, dan wawancara singkat.'],
                ['q'=>'Apakah ada jaminan pembayaran?', 'a'=>'Ya, sistem escrow melindungi dana Anda sampai proyek selesai.'],
                ['q'=>'Berapa fee platform?', 'a'=>'Hanya 5% dari nilai proyek, transparan tanpa biaya tersembunyi.'],
                ['q'=>'Dukungan teknis 24 jam?', 'a'=>'Tim support kami siap membantu via live chat dan email.'],
            ]; @endphp
            @foreach($faqs as $index=>$faq)
            <div class="glass-card-premium rounded-xl overflow-hidden">
                <button class="faq-trigger w-full text-left p-5 flex justify-between items-center font-semibold text-white">
                    {{ $faq['q'] }}
                    <i class="fas fa-chevron-down transition-transform duration-300"></i>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 px-5 text-gray-300 border-t border-transparent">
                    <p class="py-4">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- CTA Aurora Gradient + Glow -->
    <div class="aurora-bg rounded-3xl p-[2px] my-20" data-aos="flip-up">
        <div class="bg-slate-950/70 backdrop-blur-xl rounded-3xl p-10 text-center">
            <h3 class="text-3xl md:text-4xl font-bold">Ready to elevate your freelance journey?</h3>
            <p class="text-gray-200 mt-3 max-w-lg mx-auto">Join thousands of professionals using SkillBantuin daily.</p>
            <div class="flex justify-center gap-4 mt-8">
                <a href="#" class="magnetic-btn px-8 py-3 rounded-full bg-white text-slate-900 font-bold shadow-xl hover:shadow-white/30">Get Started</a>
                <a href="#" class="magnetic-btn px-8 py-3 rounded-full bg-transparent border border-white text-white font-bold hover:bg-white/10">Learn More</a>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // Counter Animation
    const counters = document.querySelectorAll('.stat-number');
    const animateNumber = (el) => {
        const target = parseInt(el.getAttribute('data-target'));
        let current = 0;
        const increment = target / 50;
        const update = () => {
            current += increment;
            if(current < target) {
                el.innerText = Math.floor(current);
                requestAnimationFrame(update);
            } else {
                el.innerText = target;
            }
        };
        update();
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                animateNumber(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(counter => observer.observe(counter));

    // Testimonial Carousel
    const track = document.getElementById('carouselTrack');
    const prevBtn = document.getElementById('prevTesti');
    const nextBtn = document.getElementById('nextTesti');
    let currentIdx = 0;
    const slides = document.querySelectorAll('#carouselTrack > div');
    const total = slides.length;
    function updateCarousel() {
        track.style.transform = `translateX(-${currentIdx * 100}%)`;
    }
    if(nextBtn) {
        nextBtn.addEventListener('click', () => { currentIdx = (currentIdx+1)%total; updateCarousel(); });
        prevBtn.addEventListener('click', () => { currentIdx = (currentIdx-1+total)%total; updateCarousel(); });
        setInterval(() => { currentIdx = (currentIdx+1)%total; updateCarousel(); }, 5000);
    }

    // FAQ smooth height
    document.querySelectorAll('.faq-trigger').forEach(btn => {
        btn.addEventListener('click', () => {
            const answer = btn.nextElementSibling;
            const icon = btn.querySelector('i');
            const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
            document.querySelectorAll('.faq-answer').forEach(a => a.style.maxHeight = null);
            document.querySelectorAll('.faq-trigger i').forEach(i => i.style.transform = 'rotate(0deg)');
            if(!isOpen) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.style.maxHeight = null;
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });
</script>
@endpush
@endsection
