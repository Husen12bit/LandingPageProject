@extends('layouts.landing')

@section('title', 'Beranda - Platform Freelance')

@section('content')
<style>
    .hero {
        background: linear-gradient(135deg, #1dbf73 0%, #0e8f56 100%);
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        opacity: 0.1;
        z-index: 0;
    }

    .hero .container {
        position: relative;
        z-index: 1;
    }

    .hero h1 {
        font-size: 52px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 20px;
        margin-bottom: 30px;
        opacity: 0.95;
    }

    .search-box {
        background: white;
        border-radius: 8px;
        padding: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        max-width: 600px;
        margin: 0 auto;
    }

    .search-box input {
        border: none;
        padding: 12px 20px;
        font-size: 16px;
    }

    .search-box input:focus {
        box-shadow: none;
        border: none;
        outline: none;
    }

    .search-box button {
        background: #1dbf73;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
    }

    .search-box button:hover {
        background: #19a463;
    }

    /* Categories Section */
    .categories {
        padding: 80px 0;
        background: #fff;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        color: #404145;
        margin-bottom: 15px;
    }

    .section-title p {
        color: #62646a;
        font-size: 18px;
    }

    .category-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: 10px;
        transition: all 0.3s;
        cursor: pointer;
        background: #fff;
        border: 1px solid #e4e4e4;
        margin-bottom: 30px;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #1dbf73;
    }

    .category-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #1dbf73 0%, #0e8f56 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .category-icon i {
        font-size: 35px;
        color: white;
    }

    .category-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #404145;
    }

    .category-card p {
        color: #62646a;
        font-size: 14px;
        margin: 0;
    }

    /* Popular Services */
    .popular-services {
        padding: 80px 0;
        background: #fafafa;
    }

    .service-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .service-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }

    .service-body {
        padding: 20px;
    }

    .service-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #404145;
    }

    .service-desc {
        color: #62646a;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .service-price {
        color: #1dbf73;
        font-weight: 700;
        font-size: 18px;
    }

    .service-rating {
        color: #ffb33e;
        margin-bottom: 10px;
    }

    /* How It Works */
    .how-it-works {
        padding: 80px 0;
        background: white;
    }

    .step-card {
        text-align: center;
        padding: 30px;
    }

    .step-number {
        width: 60px;
        height: 60px;
        background: #1dbf73;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        margin: 0 auto 20px;
    }

    .step-card h4 {
        margin-bottom: 15px;
        color: #404145;
    }

    /* Testimonials */
    .testimonials {
        padding: 80px 0;
        background: linear-gradient(135deg, #1dbf73 0%, #0e8f56 100%);
        color: white;
    }

    .testimonial-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        padding: 30px;
        margin: 20px;
        text-align: center;
    }

    .testimonial-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        border: 3px solid white;
    }

    .testimonial-text {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .testimonial-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: #fafafa;
        text-align: center;
    }

    .cta-section h3 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #404145;
    }

    .btn-cta {
        background: #1dbf73;
        color: white;
        padding: 15px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 8px;
        margin-top: 20px;
    }

    .btn-cta:hover {
        background: #19a463;
        color: white;
        transform: translateY(-2px);
    }
</style>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1>Temukan Layanan Freelance <br>Terbaik untuk Bisnis Anda</h1>
                <p>Terhubung dengan freelancer berbakat dari seluruh Indonesia</p>
                <div class="search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari layanan yang Anda butuhkan...">
                        <button class="btn btn-success" type="button">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="categories">
    <div class="container">
        <div class="section-title">
            <h2>Kategori Populer</h2>
            <p>Temukan freelancer ahli di berbagai bidang</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h4>Pengembangan Web</h4>
                    <p>PHP, React, Laravel, Node.js</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Aplikasi Mobile</h4>
                    <p>Flutter, Kotlin, Swift, React Native</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h4>Desain & Kreatif</h4>
                    <p>UI/UX, Logo, Branding, Grafis</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Pemasaran Digital</h4>
                    <p>SEO, Medsos, Konten, Iklan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Services -->
<div class="popular-services">
    <div class="container">
        <div class="section-title">
            <h2>Layanan Populer</h2>
            <p>Layanan terbaik dari freelancer berbakat kami</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" class="service-img" alt="Web Development">
                    <div class="service-body">
                        <div class="service-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-muted">(128)</span>
                        </div>
                        <h5 class="service-title">Pengembangan Website Full Stack</h5>
                        <p class="service-desc">Bangun website modern dengan Laravel & React</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="service-price">Mulai Rp500.000</span>
                            <a href="#" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" class="service-img" alt="Mobile App">
                    <div class="service-body">
                        <div class="service-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-muted">(95)</span>
                        </div>
                        <h5 class="service-title">Pengembangan Aplikasi Mobile Flutter</h5>
                        <p class="service-desc">Aplikasi mobile cross-platform untuk Android & iOS</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="service-price">Mulai Rp750.000</span>
                            <a href="#" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2064&q=80" class="service-img" alt="UI/UX Design">
                    <div class="service-body">
                        <div class="service-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-muted">(210)</span>
                        </div>
                        <h5 class="service-title">Desain UI/UX untuk Aplikasi & Website</h5>
                        <p class="service-desc">Desain antarmuka modern & user-friendly</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="service-price">Mulai Rp400.000</span>
                            <a href="#" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- How It Works -->
<div class="how-it-works">
    <div class="container">
        <div class="section-title">
            <h2>Cara Kerjanya</h2>
            <p>Langkah mudah untuk menyelesaikan proyek Anda</p>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Posting Proyek</h4>
                    <p class="text-muted">Ceritakan kebutuhan Anda dan tentukan anggaran</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Terima Penawaran</h4>
                    <p class="text-muted">Dapatkan penawaran dari freelancer berkualitas</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Pilih & Bekerja Sama</h4>
                    <p class="text-muted">Pilih freelancer terbaik dan mulai bekerja</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h4>Bayar dengan Aman</h4>
                    <p class="text-muted">Bayar setelah Anda puas dengan hasilnya</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="testimonials">
    <div class="container">
        <div class="section-title">
            <h2 style="color: white;">Apa Kata Klien Kami</h2>
            <p style="color: rgba(255,255,255,0.9);">Dipercaya oleh ribuan klien yang puas</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" class="testimonial-img" alt="Klien">
                    <p class="testimonial-text">"Platform yang luar biasa! Menemukan developer berbakat yang membangun website saya dengan sempurna. Sangat direkomendasikan!"</p>
                    <p class="testimonial-name">Budi Santoso</p>
                    <small>CEO, Tech Startup</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" class="testimonial-img" alt="Klien">
                    <p class="testimonial-text">"Freelancer di sini profesional dan sangat ahli. Pasti akan menggunakan platform ini lagi."</p>
                    <p class="testimonial-name">Dewi Lestari</p>
                    <small>Direktur Pemasaran</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/3.jpg" class="testimonial-img" alt="Klien">
                    <p class="testimonial-text">"Pengalaman yang menyenangkan dari awal hingga akhir. Tim dukungannya juga sangat responsif."</p>
                    <p class="testimonial-name">Agus Wijaya</p>
                    <small>Pemilik Bisnis</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="cta-section">
    <div class="container">
        <h3>Siap Memulai Proyek Anda?</h3>
        <p class="text-muted">Bergabunglah dengan ribuan klien yang sudah menemukan freelancer terbaik mereka</p>
        <a href="#" class="btn btn-cta">Mulai Sekarang <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
@endsection
