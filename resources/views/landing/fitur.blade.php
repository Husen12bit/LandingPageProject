@extends('layouts.landing')

@section('title', 'Fitur - Platform Freelance')

@section('content')
<style>
    .page-header {
        background-color: #f8f9fa;
        padding: 60px 0;
        text-align: center;
    }

    .fitur-list {
        padding: 60px 0;
    }

    .fitur-item {
        padding: 30px;
        margin-bottom: 30px;
        border: 1px solid #eee;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s;
    }

    .fitur-item:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .fitur-item i {
        font-size: 50px;
        color: #1dbf73;
        margin-bottom: 20px;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Fitur Unggulan</h1>
        <p class="lead">Kami hadir dengan berbagai fitur untuk memudahkan Anda</p>
    </div>
</div>

<div class="fitur-list">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-search"></i>
                    <h4>Cari Freelancer</h4>
                    <p>Temukan freelancer sesuai dengan kebutuhan dan budget Anda</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-comments"></i>
                    <h4>Chat Real-time</h4>
                    <p>Komunikasi langsung dengan freelancer melalui fitur chat</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-credit-card"></i>
                    <h4>Pembayaran Aman</h4>
                    <p>Menjamin pembayaran Anda aman</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-star"></i>
                    <h4>Rating & Review</h4>
                    <p>Lihat rating dan review dari klien sebelumnya</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-clock"></i>
                    <h4>24/7 Support</h4>
                    <p>Tim support siap membantu Anda kapan saja</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-item">
                    <i class="fas fa-chart-line"></i>
                    <h4>Track Project</h4>
                    <p>Pantau perkembangan project secara real-time</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
