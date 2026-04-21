<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seeder Kategori
        $this->seedKategoris();

        // 2. Seeder Freelancer
        $this->seedFreelancers();

        // 3. Seeder Client
        $this->seedClients();

        // 4. Seeder Project
        $this->seedProjects();

        // 5. Seeder Bid
        $this->seedBids();

        // 6. Seeder User (Admin)
        $this->seedUsers();

        $this->command->info('✅ Semua data dummy berhasil diisi!');
    }

    private function seedKategoris(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Web Development',
                'icon' => 'fab fa-laravel',
                'deskripsi' => 'Pengembangan website menggunakan Laravel, React, Vue.js, dan teknologi modern lainnya',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Mobile Development',
                'icon' => 'fab fa-android',
                'deskripsi' => 'Aplikasi mobile Android dan iOS menggunakan Flutter, Kotlin, Swift',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'UI/UX Design',
                'icon' => 'fas fa-paint-brush',
                'deskripsi' => 'Desain antarmuka pengguna yang modern dan user-friendly',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Digital Marketing',
                'icon' => 'fas fa-chart-line',
                'deskripsi' => 'Pemasaran digital, SEO, social media management',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Data Science',
                'icon' => 'fas fa-database',
                'deskripsi' => 'Analisis data, machine learning, dan AI',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kategori' => 'Writing & Translation',
                'icon' => 'fas fa-pen-fancy',
                'deskripsi' => 'Penulisan konten, artikel, dan jasa terjemahan',
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    private function seedFreelancers(): void
    {
        DB::table('freelancers')->insert([
            [
                'nama_lengkap' => 'Ahmad Fadli',
                'email' => 'ahmad.fadli@example.com',
                'no_telepon' => '081234567890',
                'keahlian' => 'Laravel Developer',
                'portfolio' => 'https://github.com/ahmadfadli',
                'deskripsi' => 'Fullstack developer dengan pengalaman 5 tahun di Laravel dan React. Selesai mengerjakan 50+ proyek.',
                'harga_per_hari' => 500000,
                'pengalaman_tahun' => 5,
                'rating' => 4.8,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'no_telepon' => '081234567891',
                'keahlian' => 'Flutter Developer',
                'portfolio' => 'https://github.com/budisantoso',
                'deskripsi' => 'Mobile developer expert Flutter, sudah membuat 30+ aplikasi mobile.',
                'harga_per_hari' => 450000,
                'pengalaman_tahun' => 4,
                'rating' => 4.7,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Citra Dewi',
                'email' => 'citra.dewi@example.com',
                'no_telepon' => '081234567892',
                'keahlian' => 'UI/UX Designer',
                'portfolio' => 'https://behance.net/citradewi',
                'deskripsi' => 'UI/UX designer dengan pengalaman 4 tahun, spesialis desain modern dan user-friendly.',
                'harga_per_hari' => 400000,
                'pengalaman_tahun' => 4,
                'rating' => 4.9,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Dian Pratama',
                'email' => 'dian.pratama@example.com',
                'no_telepon' => '081234567893',
                'keahlian' => 'SEO Specialist',
                'portfolio' => 'https://github.com/dianpratama',
                'deskripsi' => 'Ahli SEO dengan sertifikasi Google, sudah menaikkan ranking 100+ website.',
                'harga_per_hari' => 350000,
                'pengalaman_tahun' => 3,
                'rating' => 4.6,
                'status' => 'verifikasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_lengkap' => 'Eka Saputra',
                'email' => 'eka.saputra@example.com',
                'no_telepon' => '081234567894',
                'keahlian' => 'Data Scientist',
                'portfolio' => 'https://github.com/ekasaputra',
                'deskripsi' => 'Data scientist expert di Python, TensorFlow, dan analisis big data.',
                'harga_per_hari' => 600000,
                'pengalaman_tahun' => 5,
                'rating' => 4.9,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    private function seedClients(): void
    {
        DB::table('clients')->insert([
            [
                'nama_perusahaan' => 'PT Tech Indonesia',
                'nama_kontak' => 'Andi Wijaya',
                'email' => 'andi@techindo.com',
                'no_telepon' => '0215551234',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Selatan',
                'bidang_usaha' => 'Teknologi',
                'total_proyek' => 15,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'CV Kreatif Abadi',
                'nama_kontak' => 'Bambang Hermawan',
                'email' => 'bambang@kreatifabadi.com',
                'no_telepon' => '0225555678',
                'alamat' => 'Jl. Setiabudi No. 45, Bandung',
                'bidang_usaha' => 'Kreatif & Desain',
                'total_proyek' => 8,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Digital Marketing Pro',
                'nama_kontak' => 'Catherine Lim',
                'email' => 'catherine@digimarkpro.com',
                'no_telepon' => '0315559101',
                'alamat' => 'Jl. Basuki Rahmat No. 78, Surabaya',
                'bidang_usaha' => 'Marketing Digital',
                'total_proyek' => 25,
                'status' => 'aktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Fintech Solusi',
                'nama_kontak' => 'Deni Susanto',
                'email' => 'deni@fintechsolusi.com',
                'no_telepon' => '0215551122',
                'alamat' => 'Jl. Gatot Subroto No. 99, Jakarta Pusat',
                'bidang_usaha' => 'Fintech',
                'total_proyek' => 12,
                'status' => 'nonaktif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    private function seedProjects(): void
    {
        DB::table('projects')->insert([
            [
                'client_id' => 1,
                'kategori_id' => 1,
                'judul' => 'Website E-commerce untuk PT Tech Indonesia',
                'deskripsi' => 'Membangun website e-commerce modern dengan fitur payment gateway, manajemen produk, dan dashboard admin.',
                'anggaran_min' => 15000000,
                'anggaran_max' => 25000000,
                'deadline' => Carbon::now()->addDays(30),
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 2,
                'kategori_id' => 2,
                'judul' => 'Aplikasi Mobile Pemesanan Makanan',
                'deskripsi' => 'Membuat aplikasi mobile untuk pemesanan makanan online (Android & iOS) dengan Flutter.',
                'anggaran_min' => 20000000,
                'anggaran_max' => 35000000,
                'deadline' => Carbon::now()->addDays(45),
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 3,
                'kategori_id' => 3,
                'judul' => 'Redesain UI/UX Website Perusahaan',
                'deskripsi' => 'Mendesain ulang tampilan website perusahaan agar lebih modern dan user-friendly.',
                'anggaran_min' => 8000000,
                'anggaran_max' => 12000000,
                'deadline' => Carbon::now()->addDays(20),
                'status' => 'open',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 1,
                'kategori_id' => 4,
                'judul' => 'SEO Optimization Website',
                'deskripsi' => 'Optimasi SEO untuk meningkatkan trafik website ke halaman pertama Google.',
                'anggaran_min' => 5000000,
                'anggaran_max' => 10000000,
                'deadline' => Carbon::now()->addDays(60),
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_id' => 4,
                'kategori_id' => 5,
                'judul' => 'Analisis Data Penjualan',
                'deskripsi' => 'Menganalisis data penjualan perusahaan untuk mencari insight bisnis.',
                'anggaran_min' => 12000000,
                'anggaran_max' => 18000000,
                'deadline' => Carbon::now()->addDays(25),
                'status' => 'cancelled',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    private function seedBids(): void
    {
        DB::table('bids')->insert([
            [
                'project_id' => 1,
                'freelancer_id' => 1,
                'harga_penawaran' => 18000000,
                'pesan_penawaran' => 'Saya sudah berpengalaman membuat 5 website e-commerce dengan Laravel. Saya bisa selesaikan dalam 25 hari.',
                'estimasi_hari' => 25,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 1,
                'freelancer_id' => 2,
                'harga_penawaran' => 20000000,
                'pesan_penawaran' => 'Saya bisa bantu dengan tim fullstack developer. Hasil terjamin kualitasnya.',
                'estimasi_hari' => 30,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 2,
                'freelancer_id' => 2,
                'harga_penawaran' => 28000000,
                'pesan_penawaran' => 'Saya expert di Flutter, sudah membuat 15+ aplikasi mobile. Hasil akan rapi dan responsif.',
                'estimasi_hari' => 40,
                'status' => 'accepted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 3,
                'freelancer_id' => 3,
                'harga_penawaran' => 10000000,
                'pesan_penawaran' => 'Portfolio UI/UX saya sudah teruji. Saya jamin desain yang modern dan user-friendly.',
                'estimasi_hari' => 15,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'project_id' => 4,
                'freelancer_id' => 4,
                'harga_penawaran' => 7000000,
                'pesan_penawaran' => 'Saya ahli SEO dengan sertifikasi Google. Website Anda akan naik peringkat.',
                'estimasi_hari' => 20,
                'status' => 'rejected',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    private function seedUsers(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin SkillBantuin',
            'email' => 'admin@skillbantuin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
