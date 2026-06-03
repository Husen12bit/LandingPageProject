@extends('layouts.admin')

@section('title', 'Data Offer')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold"><i class="fas fa-handshake text-orange-400 mr-2"></i> Penawaran Khusus (Offers)</h2>
    </div>
    @if(session('success'))<div class="bg-emerald-500/20 border border-emerald-400/50 text-emerald-300 px-4 py-3 rounded-lg mb-5">{{ session('success') }}</div>@endif
    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead><tr><th>No</th><th>Proyek</th><th>Freelancer</th><th>Budget Ditawar</th><th>Deadline (hari)</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
                @forelse($offers as $key => $offer)
                <tr>
                    <td>{{ $offers->firstItem() + $key }}</td>
                    <td>{{ Str::limit($offer->project->judul ?? '-', 40) }}</td>
                    <td>{{ $offer->freelancer->nama_lengkap ?? '-' }}</td>
                    <td>Rp {{ number_format($offer->offered_budget,0,',','.') }}</td>
                    <td>{{ $offer->proposed_deadline_days }} hari</td>
                    <td>@if($offer->status=='accepted')<span class="badge-emerald">Accepted</span>@elseif($offer->status=='pending')<span class="badge-yellow">Pending</span>@elseif($offer->status=='countered')<span class="badge-purple">Countered</span>@else<span class="badge-gray">Rejected</span>@endif</td>
                    <td class="text-center"><a href="{{ route('offer.show', $offer->id) }}" class="text-blue-400"><i class="fas fa-eye"></i></a> <a href="{{ route('offer.edit', $offer->id) }}" class="text-yellow-400"><i class="fas fa-edit"></i></a></td>
                </tr>
                @empty <tr><td colspan="7" class="text-center py-6">Belum ada offer</td></tr> @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $offers->links() }}</div>
</div>
@endsection
