@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 14px;
    }

    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .latest-table {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .latest-table table {
        margin-bottom: 0;
    }
</style>

<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Dashboard Admin</h2>
            <p class="text-muted">Selamat datang di panel administrasi SkillBantuin</p>
        </div>
        <div class="text-muted">
            <i class="fas fa-calendar-alt"></i> {{ date('d F Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(29, 191, 115, 0.1); color: #1dbf73;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-number">{{ $totalFreelancer }}</div>
                <div class="stat-label">Total Freelancer</div>
                <small class="text-success"><i class="fas fa-check-circle"></i> {{ $freelancerAktif }} aktif</small>
                <small class="text-warning ms-2"><i class="fas fa-clock"></i> {{ $freelancerVerifikasi }} verifikasi</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-number">{{ $totalClient }}</div>
                <div class="stat-label">Total Client</div>
                <small class="text-success"><i class="fas fa-check-circle"></i> {{ $clientAktif }} aktif</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="stat-number">{{ $totalKategori }}</div>
                <div class="stat-label">Total Kategori</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(23, 162, 184, 0.1); color: #17a2b8;">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div class="stat-number">{{ $totalProject }}</div>
                <div class="stat-label">Total Proyek</div>
                <div>
                    <small class="text-success"><i class="fas fa-play-circle"></i> {{ $projectOpen }} open</small>
                    <small class="text-warning ms-2"><i class="fas fa-spinner"></i> {{ $projectProgress }} progress</small>
                    <small class="text-info ms-2"><i class="fas fa-check-circle"></i> {{ $projectCompleted }} selesai</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="stat-number">{{ $totalBid }}</div>
                <div class="stat-label">Total Penawaran</div>
                <div>
                    <small class="text-warning"><i class="fas fa-clock"></i> {{ $bidPending }} pending</small>
                    <small class="text-success ms-2"><i class="fas fa-check"></i> {{ $bidAccepted }} accepted</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-4">
        <div class="col-md-7">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-line"></i> Statistik 7 Hari Terakhir</h5>
                <canvas id="weeklyChart" height="250"></canvas>
            </div>
        </div>
        <div class="col-md-5">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-pie"></i> Proyek per Kategori</h5>
                <canvas id="kategoriChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Latest Data Row -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="latest-table">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fas fa-user-plus"></i> Freelancer Terbaru</h5>
                    <a href="{{ route('freelancer.index') }}" class="btn btn-sm btn-success">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Keahlian</th>
                                <th>Harga/Hari</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestFreelancers as $freelancer)
                            <tr>
                                <td>{{ $freelancer->nama_lengkap }}</td>
                                <td>{{ $freelancer->keahlian }}</td>
                                <td>Rp {{ number_format($freelancer->harga_per_hari, 0, ',', '.') }}</td>
                                <td>
                                    @if($freelancer->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($freelancer->status == 'verifikasi')
                                        <span class="badge bg-warning">Verifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data freelancer</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="latest-table">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fas fa-project-diagram"></i> Proyek Terbaru</h5>
                    <a href="{{ route('project.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Client</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestProjects as $project)
                            <tr>
                                <td>{{ Str::limit($project->judul, 25) }}</td>
                                <td>{{ $project->client->nama_perusahaan ?? '-' }}</td>
                                <td>{{ $project->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    @if($project->status == 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($project->status == 'in_progress')
                                        <span class="badge bg-warning">In Progress</span>
                                    @elseif($project->status == 'completed')
                                        <span class="badge bg-info">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data proyek</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Menu -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-rocket"></i> Menu Cepat</h5>
                <div class="row">
                    <div class="col-md-2 col-6 mb-2">
                        <a href="{{ route('freelancer.index') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-user fa-2x d-block mb-2"></i>
                            Freelancer
                        </a>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <a href="{{ route('client.index') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-building fa-2x d-block mb-2"></i>
                            Client
                        </a>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-tag fa-2x d-block mb-2"></i>
                            Kategori
                        </a>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <a href="{{ route('project.index') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-project-diagram fa-2x d-block mb-2"></i>
                            Proyek
                        </a>
                    </div>
                    <div class="col-md-2 col-6 mb-2">
                        <a href="{{ route('bid.index') }}" class="btn btn-outline-danger w-100 py-3">
                            <i class="fas fa-gavel fa-2x d-block mb-2"></i>
                            Penawaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart 7 Hari Terakhir
    const ctx1 = document.getElementById('weeklyChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Freelancer Baru',
                    data: {!! json_encode($freelancerData) !!},
                    borderColor: '#1dbf73',
                    backgroundColor: 'rgba(29, 191, 115, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Proyek Baru',
                    data: {!! json_encode($projectData) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    // Chart Kategori Proyek
    const ctx2 = document.getElementById('kategoriChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: {!! json_encode($kategoriLabels) !!},
            datasets: [{
                data: {!! json_encode($kategoriData) !!},
                backgroundColor: [
                    '#1dbf73',
                    '#0d6efd',
                    '#ffc107',
                    '#dc3545',
                    '#17a2b8',
                    '#6f42c1',
                    '#fd7e14',
                    '#20c997'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
</script>
@endpush
