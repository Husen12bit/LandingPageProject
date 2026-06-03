@extends('layouts.landing')

@section('content')
<div class="container mx-auto px-6">
    <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-purple-400 to-teal-400 bg-clip-text text-transparent">Help Center</h1>
        <p class="text-gray-300 text-lg mt-3">We're here to help, 24 hours a day.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-16" data-aos="fade-up">
        <div class="glass-card-premium p-6 text-center border-t-2 border-teal-500">
            <i class="fas fa-clock text-3xl text-teal-400"></i>
            <p class="text-2xl font-bold mt-2">Avg. Response</p>
            <p class="text-gray-300">< 24 minutes</p>
        </div>
        <div class="glass-card-premium p-6 text-center border-t-2 border-emerald-500">
            <i class="fas fa-smile text-3xl text-emerald-400"></i>
            <p class="text-2xl font-bold mt-2">98% Satisfaction</p>
            <p class="text-gray-300">from 5k+ tickets</p>
        </div>
        <div class="glass-card-premium p-6 text-center border-t-2 border-purple-500">
            <i class="fas fa-globe text-3xl text-purple-400"></i>
            <p class="text-2xl font-bold mt-2">24/7 Support</p>
            <p class="text-gray-300">Live chat & email</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-10 items-start">
        <div class="space-y-6" data-aos="fade-right">
            <div class="glass-card-premium p-6 rounded-2xl flex gap-4 items-center border-l-4 border-teal-500">
                <i class="fas fa-map-pin text-2xl text-teal-400"></i>
                <div><h4 class="font-bold">Office</h4><p class="text-gray-300">Gedhang, Indonesia — Digital Hub</p></div>
            </div>
            <div class="glass-card-premium p-6 rounded-2xl flex gap-4 items-center border-l-4 border-purple-500">
                <i class="fas fa-phone-alt text-2xl text-purple-400"></i>
                <div><h4 class="font-bold">Phone</h4><p class="text-gray-300">+62 812 7482 0784</p></div>
            </div>
            <div class="glass-card-premium p-6 rounded-2xl flex gap-4 items-center border-l-4 border-emerald-500">
                <i class="fas fa-envelope text-2xl text-emerald-400"></i>
                <div><h4 class="font-bold">Email</h4><p class="text-gray-300">info@SkillBantuin.com</p></div>
            </div>
        </div>

        <div class="glass-card-premium p-8 rounded-2xl" data-aos="fade-left">
            <h3 class="text-2xl font-bold mb-6">Kirim Pesan</h3>
            <form id="supportForm" class="space-y-5">
                <div class="relative">
                    <input type="text" id="name" required class="peer w-full bg-transparent border-b-2 border-gray-500 focus:border-teal-500 outline-none py-2 text-white transition-all" placeholder=" ">
                    <label class="absolute left-0 -top-3.5 text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-teal-400">Nama Lengkap</label>
                </div>
                <div class="relative">
                    <input type="email" id="email" required class="peer w-full bg-transparent border-b-2 border-gray-500 focus:border-teal-500 outline-none py-2 text-white" placeholder=" ">
                    <label class="absolute left-0 -top-3.5 text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-teal-400">Email</label>
                </div>
                <div>
                    <select class="w-full bg-slate-800/60 border border-gray-600 rounded-lg p-3 text-white focus:ring-2 focus:ring-teal-500 outline-none">
                        <option>Topik Kendala</option>
                        <option>Akun & Login</option>
                        <option>Pembayaran</option>
                        <option>Proyek</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div class="relative">
                    <textarea rows="4" required class="peer w-full bg-transparent border-b-2 border-gray-500 focus:border-teal-500 outline-none py-2 text-white resize-none" placeholder=" "></textarea>
                    <label class="absolute left-0 -top-3.5 text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-teal-400">Pesan detail</label>
                </div>
                <button type="submit" class="w-full magnetic-btn py-3 rounded-xl btn-teal text-white font-bold transition-all hover:shadow-lg">Kirim Pesan <i class="fas fa-paper-plane ml-2"></i></button>
                <p class="text-xs text-teal-400 text-center mt-3"><i class="fas fa-shield-alt"></i> Tim kami merespon < 24 jam (biasanya 2 jam)</p>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    document.getElementById('supportForm')?.addEventListener('submit', function(e){
        e.preventDefault();
        alert('Pesan terkirim! Support akan menghubungi Anda segera.');
        this.reset();
    });
</script>
@endpush
@endsection
