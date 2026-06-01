@extends('layouts.landing')

@section('content')
<div class="container mx-auto px-6">
    <!-- Page header -->
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-400 to-orange-400 bg-clip-text text-transparent">Powerful Features, <br>Beautifully Crafted</h1>
        <p class="text-gray-300 text-lg mt-4">Everything you need to scale your freelance business.</p>
    </div>

    <!-- Bento Grid asimetris ala Linear/Vercel -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-min" data-aos="fade-up">
        <div class="glass-card-premium p-6 rounded-2xl md:col-span-2 row-span-2 hover-lift group">
            <i class="fas fa-search text-4xl text-purple-400 group-hover:scale-110 transition"></i>
            <h3 class="text-2xl font-bold mt-4">Smart Search & Match</h3>
            <p class="text-gray-300 mt-2">AI-curated freelancers based on your project needs and budget.</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-comment-dots text-3xl text-orange-400"></i>
            <h3 class="text-xl font-bold mt-2">Real-time Chat</h3>
            <p class="text-gray-300 text-sm">Instant messaging with file sharing & notifications.</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-chart-simple text-3xl text-cyan-400"></i>
            <h3 class="text-xl font-bold mt-2">Analytics Dashboard</h3>
            <p class="text-gray-300 text-sm">Insights on project progress, spending, and team performance.</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl md:col-span-2 hover-lift">
            <i class="fas fa-clock text-3xl text-purple-300"></i>
            <h3 class="text-xl font-bold mt-2">Time & Milestone Tracker</h3>
            <p class="text-gray-300 text-sm">Automated timesheets and milestone approvals.</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl hover-lift">
            <i class="fas fa-star-of-life text-3xl text-orange-300"></i>
            <h3 class="text-xl font-bold mt-2">Reviews & Reputation</h3>
            <p class="text-gray-300 text-sm">Trust-building with verified reviews.</p>
        </div>
        <div class="glass-card-premium p-6 rounded-2xl row-span-1 hover-lift">
            <i class="fas fa-headset text-3xl text-cyan-300"></i>
            <h3 class="text-xl font-bold mt-2">Priority Support</h3>
            <p class="text-gray-300 text-sm">24/7 concierge for enterprise clients.</p>
        </div>
    </div>

    <!-- Deep Dive: System Status Visibility + Zigzag -->
    <div class="my-32 grid md:grid-cols-2 gap-12 items-center" data-aos="fade-up">
        <div class="glass-card-premium p-8 rounded-2xl">
            <i class="fas fa-eye text-5xl text-purple-400 mb-4"></i>
            <h3 class="text-2xl font-bold">Visibility of System Status</h3>
            <p class="mt-4 text-gray-200 leading-relaxed">
                Setiap tahap proyek — dari “Proposal Diterima” hingga “Pengerjaan”, “Revisi”, dan “Selesai” — disertai umpan balik visual real-time, progress bar, dan notifikasi push. Prinsip <strong>Jakob Nielsen #1</strong> kami terapkan untuk transparansi penuh.
            </p>
            <div class="mt-6 flex items-center gap-3 text-sm">
                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span> Live Tracking Active
            </div>
        </div>
        <div class="relative flex justify-center">
            <div class="w-64 h-64 rounded-full bg-gradient-to-tr from-purple-700/40 to-orange-500/40 flex items-center justify-center backdrop-blur border border-white/20">
                <i class="fas fa-diagram-project text-7xl text-white"></i>
            </div>
        </div>
    </div>
</div>
@endsection
