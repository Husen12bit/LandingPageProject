@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="glass-card p-5 rounded-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Freelancer</p>
                    <p class="text-3xl font-bold text-white">{{ $totalFreelancer }}</p>
                </div>
                <i class="fas fa-user text-3xl text-emerald-400 opacity-80"></i>
            </div>
            <div class="mt-3 text-xs text-gray-400 flex gap-3">
                <span class="text-emerald-400"><i class="fas fa-check-circle"></i> Aktif: {{ $freelancerAktif }}</span>
                <span class="text-yellow-400"><i class="fas fa-clock"></i> Verif: {{ $freelancerVerifikasi }}</span>
            </div>
        </div>
        <div class="glass-card p-5 rounded-2xl">
            <div class="flex items-center justify-between">
                <div><p class="text-gray-400 text-sm">Total Client</p><p class="text-3xl font-bold">{{ $totalClient }}</p></div>
                <i class="fas fa-building text-3xl text-teal-400"></i>
            </div>
            <div class="mt-2 text-xs text-emerald-400"><i class="fas fa-check-circle"></i> Aktif: {{ $clientAktif }}</div>
        </div>
        <div class="glass-card p-5 rounded-2xl">
            <div class="flex items-center justify-between">
                <div><p class="text-gray-400 text-sm">Total Proyek</p><p class="text-3xl font-bold">{{ $totalProject }}</p></div>
                <i class="fas fa-project-diagram text-3xl text-purple-400"></i>
            </div>
            <div class="mt-2 text-xs flex gap-2 flex-wrap">
                <span class="text-emerald-400">Open: {{ $projectOpen }}</span>
                <span class="text-yellow-400">Progress: {{ $projectProgress }}</span>
                <span class="text-blue-400">Selesai: {{ $projectCompleted }}</span>
            </div>
        </div>
        <div class="glass-card p-5 rounded-2xl">
            <div class="flex items-center justify-between">
                <div><p class="text-gray-400 text-sm">Total Penawaran</p><p class="text-3xl font-bold">{{ $totalBid }}</p></div>
                <i class="fas fa-gavel text-3xl text-orange-400"></i>
            </div>
            <div class="mt-2 text-xs text-yellow-400">Pending: {{ $bidPending }}</div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="glass-card p-5 rounded-2xl">
            <h3 class="font-semibold mb-3"><i class="fas fa-chart-line text-emerald-400 mr-2"></i> Statistik 7 Hari</h3>
            <canvas id="weeklyChart" height="200"></canvas>
        </div>
        <div class="glass-card p-5 rounded-2xl">
            <h3 class="font-semibold mb-3"><i class="fas fa-chart-pie text-teal-400 mr-2"></i> Proyek per Kategori</h3>
            <canvas id="kategoriChart" height="200"></canvas>
        </div>
    </div>

    <!-- Tabel Data Terbaru -->
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold"><i class="fas fa-user-plus text-emerald-400 mr-2"></i> Freelancer Terbaru</h3>
                <a href="{{ route('freelancer.index') }}" class="text-xs text-emerald-400 hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-glass w-full">
                    <thead><tr><th>Nama</th><th>Keahlian</th><th>Harga/Hari</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestFreelancers as $f)
                        <tr>
                            <td>{{ $f->nama_lengkap }}</td>
                            <td>{{ $f->keahlian }}</td>
                            <td>Rp {{ number_format($f->harga_per_hari,0,',','.') }}</td>
                            <td>@if($f->status=='aktif')<span class="badge-emerald">Aktif</span>@elseif($f->status=='verifikasi')<span class="badge-yellow">Verif</span>@else<span class="badge-gray">Nonaktif</span>@endif</td>
                        </tr>
                        @empty <tr><td colspan="4" class="text-center">Kosong</td></tr> @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="glass-card rounded-2xl p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold"><i class="fas fa-project-diagram text-teal-400 mr-2"></i> Proyek Terbaru</h3>
                <a href="{{ route('project.index') }}" class="text-xs text-emerald-400 hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-glass w-full">
                    <thead><tr><th>Judul</th><th>Client</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($latestProjects as $p)
                        <tr>
                            <td>{{ Str::limit($p->judul, 30) }}</td>
                            <td>{{ $p->client->nama_perusahaan ?? '-' }}</td>
                            <td>@if($p->status=='open')<span class="badge-emerald">Open</span>@elseif($p->status=='in_progress')<span class="badge-yellow">Progress</span>@elseif($p->status=='completed')<span class="badge-blue">Selesai</span>@else<span class="badge-gray">Batal</span>@endif</td>
                        </tr>
                        @empty <tr><td colspan="3">Kosong</td></tr> @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="glass-card rounded-2xl p-5">
        <h3 class="font-semibold mb-3"><i class="fas fa-rocket text-purple-400 mr-2"></i> Menu Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            <a href="{{ route('freelancer.index') }}" class="text-center p-3 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 transition"><i class="fas fa-user text-emerald-400 block text-xl mb-1"></i><span class="text-xs">Freelancer</span></a>
            <a href="{{ route('client.index') }}" class="text-center p-3 rounded-xl bg-teal-500/10 hover:bg-teal-500/20 transition"><i class="fas fa-building text-teal-400 block text-xl mb-1"></i><span class="text-xs">Client</span></a>
            <a href="{{ route('kategori.index') }}" class="text-center p-3 rounded-xl bg-purple-500/10 hover:bg-purple-500/20 transition"><i class="fas fa-tag text-purple-400 block text-xl mb-1"></i><span class="text-xs">Kategori</span></a>
            <a href="{{ route('project.index') }}" class="text-center p-3 rounded-xl bg-blue-500/10 hover:bg-blue-500/20 transition"><i class="fas fa-project-diagram text-blue-400 block text-xl mb-1"></i><span class="text-xs">Proyek</span></a>
            <a href="{{ route('bid.index') }}" class="text-center p-3 rounded-xl bg-orange-500/10 hover:bg-orange-500/20 transition"><i class="fas fa-gavel text-orange-400 block text-xl mb-1"></i><span class="text-xs">Penawaran</span></a>
        </div>
    </div>
</div>

<style>
    .badge-emerald { background: #10B98120; color: #10B981; padding: 2px 8px; border-radius: 20px; font-size: 12px; }
    .badge-yellow { background: #EAB30820; color: #EAB308; padding: 2px 8px; border-radius: 20px; font-size: 12px; }
    .badge-blue { background: #3B82F620; color: #3B82F6; padding: 2px 8px; border-radius: 20px; font-size: 12px; }
    .badge-gray { background: #64748B30; color: #94A3B8; padding: 2px 8px; border-radius: 20px; font-size: 12px; }
</style>

@push('scripts')
<script>
    // Data dari controller
    const labels = @json($labels);
    const freelancerData = @json($freelancerData);
    const projectData = @json($projectData);
    const kategoriLabels = @json($kategoriLabels);
    const kategoriData = @json($kategoriData);

    new Chart(document.getElementById('weeklyChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                { label: 'Freelancer Baru', data: freelancerData, borderColor: '#10B981', backgroundColor: 'rgba(16,185,129,0.1)', tension: 0.3, fill: true },
                { label: 'Proyek Baru', data: projectData, borderColor: '#14B8A6', backgroundColor: 'rgba(20,184,166,0.05)', tension: 0.3, fill: true }
            ]
        },
        options: { responsive: true, maintainAspectRatio: true, color: '#94A3B8' }
    });
    new Chart(document.getElementById('kategoriChart'), {
        type: 'pie',
        data: { labels: kategoriLabels, datasets: [{ data: kategoriData, backgroundColor: ['#10B981','#14B8A6','#7C3AED','#F59E0B','#EF4444','#06B6D4'] }] },
        options: { responsive: true, plugins: { legend: { position: 'right', labels: { color: '#CBD5E1' } } } }
    });
</script>
@endpush
@endsection
