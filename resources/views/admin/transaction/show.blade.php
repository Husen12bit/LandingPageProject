@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4"><i class="fas fa-receipt text-blue-400 mr-2"></i> Detail Transaksi</h2>
    <div class="space-y-3">
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Order ID :</span><span class="font-mono">{{ $transaction->order_id }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Proyek :</span><span>{{ $transaction->project->judul ?? '-' }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Client :</span><span>{{ $transaction->project->client->nama_perusahaan ?? '-' }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Jumlah :</span><span>Rp {{ number_format($transaction->amount,0,',','.') }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Metode :</span><span>{{ $transaction->payment_type ?? '-' }}</span></div>
        <div class="flex py-2 border-b"><span class="text-gray-400 w-36">Status :</span><span>@if($transaction->status=='settlement')<span class="badge-emerald">Settlement</span>@elseif($transaction->status=='pending')<span class="badge-yellow">Pending</span>@else<span class="badge-gray">{{ $transaction->status }}</span>@endif</span></div>
        <div class="flex py-2"><span class="text-gray-400 w-36">Dibuat :</span><span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span></div>
    </div>
    <div class="mt-6"><a href="{{ route('transaction.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a></div>
</div>
@endsection
