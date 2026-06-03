@extends('layouts.admin')

@section('title', 'Detail Offer')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4"><i class="fas fa-info-circle text-blue-400 mr-2"></i> Detail Penawaran (Offer)</h2>
    <div class="space-y-3">
        <div class="flex py-2 border-b"><span class="text-gray-400 w-40">Proyek :</span><span>{{ $offer->project->judul ?? '-' }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-40">Freelancer :</span><span>{{ $offer->freelancer->nama_lengkap ?? '-' }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-40">Budget Ditawar :</span><span>Rp {{ number_format($offer->offered_budget,0,',','.') }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-40">Estimasi Hari :</span><span>{{ $offer->proposed_deadline_days }} hari</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-40">Status :</span><span>@if($offer->status=='accepted')<span class="badge-emerald">Accepted</span>@elseif($offer->status=='countered')<span class="badge-purple">Countered</span>@elseif($offer->status=='pending')<span class="badge-yellow">Pending</span>@else<span class="badge-gray">Rejected</span>@endif</span></div>
        <div class="flex py-2"><span class="text-gray-400 w-40">Pesan :</span><p class="flex-1">{{ $offer->message }}</p></div>
    </div>
    <div class="flex justify-between mt-6">
        <a href="{{ route('offer.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
        @if($offer->status == 'pending')
        <div class="flex gap-2">
            <a href="{{ route('offer.approve', $offer->id) }}" class="bg-emerald-600 px-5 py-2 rounded-lg">Setujui</a>
            <a href="{{ route('offer.reject', $offer->id) }}" class="bg-red-600 px-5 py-2 rounded-lg">Tolak</a>
        </div>
        @endif
    </div>
</div>
@endsection
