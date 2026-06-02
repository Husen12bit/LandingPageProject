@extends('layouts.landing')

@section('content')
<div class="container mx-auto px-6">
    <div class="text-center mb-16" data-aos="fade-up">
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-400 via-orange-400 to-cyan-400 bg-clip-text text-transparent">Engineering the Future of Work</h1>
        <p class="text-gray-300 mt-4 max-w-2xl mx-auto">Built with rock-solid architecture & military-grade security.</p>
    </div>

    <!-- Visi Misi -->
    <div class="grid md:grid-cols-2 gap-8 mb-20" data-aos="fade-right">
        <div class="glass-card-premium p-8 rounded-2xl">
            <i class="fas fa-rocket text-4xl text-purple-400"></i>
            <h3 class="text-2xl font-bold mt-3">Visi</h3>
            <p class="text-gray-300 mt-2">Menjadi infrastruktur freelance terpercaya di Asia Tenggara dengan ekosistem terbuka.</p>
        </div>
        <div class="glass-card-premium p-8 rounded-2xl">
            <i class="fas fa-bullseye text-4xl text-orange-400"></i>
            <h3 class="text-2xl font-bold mt-3">Misi</h3>
            <p class="text-gray-300 mt-2">Memastikan setiap transaksi aman, setiap talenta terverifikasi, dan setiap proyek sukses.</p>
        </div>
    </div>

    <!-- Design Philosophy + 10 Heuristics -->
    <div class="glass-card-premium p-8 rounded-2xl mb-20" data-aos="flip-left">
        <i class="fas fa-paintbrush-fine text-4xl text-cyan-400"></i>
        <h3 class="text-2xl font-bold mt-2">Design Philosophy — 10 Heuristik Nielsen</h3>
        <p class="mt-4 text-gray-200">SkillBantuin dirancang iteratif dengan kepatuhan pada prinsip Jakob Nielsen: <strong>visibility of system status, match between system and real world, user control & freedom, consistency, error prevention, recognition rather than recall, flexibility, aesthetic & minimalist design, help users recognize/diagnose errors, help & documentation</strong>. Setiap elemen UI diuji secara berkala untuk memastikan pengalaman lintas platform seamless.</p>
    </div>

    <!-- System Architecture Visualization (premium blocks) -->
    <div class="mb-20" data-aos="zoom-in">
        <h2 class="text-3xl font-bold text-center mb-8">⚡ System Architecture</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="glass-card-premium p-5 text-center border-t-4 border-purple-500">
                <i class="fas fa-database text-3xl text-purple-400"></i>
                <p class="font-mono text-sm mt-2">Normalized Relational DB (3NF)</p>
            </div>
            <div class="glass-card-premium p-5 text-center border-t-4 border-orange-500">
                <i class="fas fa-cloud-upload-alt text-3xl text-orange-400"></i>
                <p class="font-mono text-sm mt-2">AWS GuardDuty + Detective</p>
            </div>
            <div class="glass-card-premium p-5 text-center border-t-4 border-cyan-500">
                <i class="fas fa-lock text-3xl text-cyan-400"></i>
                <p class="font-mono text-sm mt-2">End-to-End Encryption</p>
            </div>
        </div>
    </div>

    <!-- Tech Stack Glow Pills -->
    <div class="text-center mb-20" data-aos="fade-up">
        <h3 class="text-2xl font-semibold mb-6">Tech Stack Enterprise</h3>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach(['Laravel 11', 'PHP 8.3', 'OracleDB', 'Flutter 3.22', 'Dart 3.4', 'AWS (EC2, RDS, S3)'] as $tech)
            <span class="px-5 py-2 rounded-full glass-premium text-sm font-mono border border-purple-500/40 shadow-glow">{{ $tech }}</span>
            @endforeach
        </div>
    </div>

    <!-- Developer Team -->
    <h2 class="text-3xl font-bold text-center mb-8">Core Team</h2>
    <div class="grid md:grid-cols-4 gap-6 mb-20">
        @php $team = [
            ['name'=>'Brayen Prasetyo', 'role'=>'Support', 'icon'=>'🧠'],
            ['name'=>'Muhammad Abdullah Husaini', 'role'=>'Web Lead', 'icon'=>'🔒'],
            ['name'=>'Pius Hari Purba', 'role'=>'Principal Designer', 'icon'=>'🎨'],
            ['name'=>'Fito Rifqi Dwi Fatoni', 'role'=>'Mobile Lead', 'icon'=>'📱']
        ]; @endphp
        @foreach($team as $member)
        <div class="glass-card-premium p-6 text-center rounded-2xl hover-lift">
            <div class="text-5xl mb-2">{{ $member['icon'] }}</div>
            <h4 class="text-xl font-bold">{{ $member['name'] }}</h4>
            <p class="text-purple-300 text-sm">{{ $member['role'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
