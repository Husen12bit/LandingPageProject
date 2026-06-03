@extends('layouts.admin')

@section('title', 'Data Transaksi')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold"><i class="fas fa-credit-card text-emerald-400 mr-2"></i> Daftar Transaksi</h2>
    </div>
    @if(session('success'))<div class="bg-emerald-500/20 border border-emerald-400/50 text-emerald-300 px-4 py-3 rounded-lg mb-5">{{ session('success') }}</div>@endif
    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead><tr><th>No</th><th>Order ID</th><th>Proyek</th><th>Jumlah</th><th>Metode</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
            <tbody>
                @forelse($transactions as $key => $trx)
                <tr>
                    <td>{{ $transactions->firstItem() + $key }}</td>
                    <td class="font-mono text-xs">{{ $trx->order_id }}</td>
                    <td>{{ $trx->project->judul ?? '-' }}</td>
                    <td>Rp {{ number_format($trx->amount,0,',','.') }}</td>
                    <td>{{ $trx->payment_type ?? '-' }}</td>
                    <td>@if($trx->status=='settlement')<span class="badge-emerald">Settlement</span>@elseif($trx->status=='pending')<span class="badge-yellow">Pending</span>@else<span class="badge-gray">{{ $trx->status }}</span>@endif</td>
                    <td class="text-center"><a href="{{ route('transaction.show', $trx->id) }}" class="text-blue-400"><i class="fas fa-eye"></i></a></td>
                </tr>
                @empty <tr><td colspan="7" class="text-center py-6">Belum ada transaksi</td></tr> @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $transactions->links() }}</div>
</div>
@endsection
