@extends('layouts.landing')

@section('title', 'About - Platform Freelance')

@section('content')
<style>
    .page-header {
        background-color: #f8f9fa;
        padding: 60px 0;
        text-align: center;
    }

    .about-content {
        padding: 60px 0;
    }

    .developer-section {
        padding: 40px 0;
        background-color: #f8f9fa;
        border-radius: 10px;
        margin-top: 30px;
    }

    .developer-card {
        text-align: center;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        transition: transform 0.3s;
    }

    .developer-card:hover {
        transform: translateY(-5px);
    }

    .developer-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #1dbf73 0%, #0e8f56 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .developer-icon i {
        font-size: 50px;
        color: white;
    }

    .tech-stack {
        padding: 40px 0;
    }

    .tech-item {
        display: inline-block;
        background: #f0f0f0;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 20px;
        font-size: 14px;
    }

    .tech-item i {
        color: #1dbf73;
        margin-right: 8px;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Tentang Kami</h1>
        <p class="lead">Mengenal lebih dekat platform freelance kami</p>
    </div>
</div>

<div class="about-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Siapa Kami?</h3>
                <p>Bantuin adalah platform freelance yang menghubungkan klien dengan freelancer berkualitas dari berbagai bidang. Kami hadir untuk memudahkan Anda menemukan talenta terbaik untuk kebutuhan project Anda.</p>
                <p>Kami berkomitmen untuk memberikan layanan terbaik dan menciptakan ekosistem freelance yang aman dan terpercaya.</p>
            </div>
            <div class="col-md-6">
                <h3>Visi & Misi</h3>
                <p><strong>Visi:</strong> Menjadi platform freelance terkemuka di Indonesia yang memberdayakan talenta lokal.</p>
                <p><strong>Misi:</strong></p>
                <ul>
                    <li>Menyediakan akses mudah bagi klien dan freelancer</li>
                    <li>Menjamin keamanan transaksi dan kualitas kerja</li>
                    <li>Mendukung pertumbuhan ekonomi kreatif</li>
                </ul>
            </div>
        </div>

        <div class="developer-section">
            <h3 class="text-center mb-5">Tim Developer</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="developer-card">
                        <div class="developer-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Support</h4>
                        <h5 class="text-success">Brayen Prasetyo</h5>
                        <p class="text-muted">Bertugas meningkatkan kesejahteraan developer.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="developer-card">
                        <div class="developer-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h4>Web Developer</h4>
                        <h5 class="text-success">Muhammad Abdullah Husaini</h5>
                        <p class="text-muted">Bertugas membangun web.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="developer-card">
                        <div class="developer-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Developer</h4>
                        <h5 class="text-success">Fito Rifqi Dwi Fatoni</h5>
                        <p class="text-muted">Bertugas membangun aplikasi mobile.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="developer-card">
                        <div class="developer-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h4>UI/UX Designer</h4>
                        <h5 class="text-success">Pius Hari Purba</h5>
                        <p class="text-muted">Merancang tampilan antarmuka yang menarik.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technology Stack -->
        <div class="tech-stack text-center">
            <h3 class="mb-4">Teknologi yang Digunakan</h3>
            <div>
                <span class="tech-item"><i class="fab fa-laravel"></i> Laravel 11</span>
                <span class="tech-item"><i class="fab fa-php"></i> PHP 8</span>
                <span class="tech-item"><i class="fas fa-database"></i> MySQL</span>
                <span class="tech-item"><i class="fab fa-aws"></i> AWS</span>
                <span class="tech-item"><i class="fab fa-bootstrap"></i> Bootstrap 5</span>
                <span class="tech-item"><i class="fab fa-flutter"></i> Flutter</span>
                <span class="tech-item"><i class="fab fa-dart"></i> Dart</span>
                <span class="tech-item"><i class="fab fa-js"></i> JavaScript</span>
                <span class="tech-item"><i class="fab fa-git-alt"></i> Git</span>
                <span class="tech-item"><i class="fas fa-cloud"></i> Cloud (AWS)</span>
            </div>
        </div>

        <!-- Project Info -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <h5 class="text-success"><i class="fas fa-info-circle"></i> Informasi Project</h5>
                    <p class="mb-0">Project ini merupakan tugas mata kuliah Pemrograman Web Lanjut. Dikembangkan menggunakan Laravel 11 dan Bootstrap 5.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
