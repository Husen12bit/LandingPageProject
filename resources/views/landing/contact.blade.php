@extends('layouts.landing')

@section('title', 'Contact - Platform Freelance')

@section('content')
<style>
    .page-header {
        background-color: #f8f9fa;
        padding: 60px 0;
        text-align: center;
    }

    .contact-section {
        padding: 60px 0;
    }

    .contact-info {
        text-align: center;
        padding: 30px;
        border: 1px solid #eee;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .contact-info i {
        font-size: 40px;
        color: #1dbf73;
        margin-bottom: 15px;
    }

    .contact-form {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 10px;
    }

    .form-control {
        margin-bottom: 20px;
        padding: 12px;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p class="lead">Ada pertanyaan? Kami siap membantu Anda</p>
    </div>
</div>

<div class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <h5>Alamat</h5>
                    <p>Gedhang, Indonesia</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <i class="fas fa-phone"></i>
                    <h5>Telepon</h5>
                    <p>+62 812 7482 0784</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <h5>Email</h5>
                    <p>info@Bantuin.com</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="contact-form">
                    <h3 class="text-center mb-4">Kirim Pesan</h3>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Subjek">
                        <textarea class="form-control" rows="5" placeholder="Pesan" required></textarea>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
