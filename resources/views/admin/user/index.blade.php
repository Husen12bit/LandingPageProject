@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center flex-wrap gap-3 mb-5">
        <h2 class="text-xl font-semibold">
            <i class="fas fa-users text-purple-400 mr-2"></i> Daftar User
        </h2>
        <a href="{{ route('user.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm">
            <i class="fas fa-plus mr-1"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-400/50 text-emerald-300 px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead>
                <tr>
                    <th class="w-12">No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="w-24">Status</th>
                    <th class="w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                <tr>
                    <td>{{ $users->firstItem() + $key }}</td>
                    <td class="font-medium">{{ $user->name }}</td>
                    <td>{{ $user->username ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge-purple">Admin</span>
                        @elseif($user->role == 'freelancer')
                            <span class="badge-emerald">Freelancer</span>
                        @else
                            <span class="badge-blue">Client</span>
                        @endif
                    </td>
                    <td>
                        @if($user->is_active)
                            <span class="badge-emerald">Aktif</span>
                        @else
                            <span class="badge-gray">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('user.show', $user->id) }}" class="text-blue-400 hover:text-blue-300" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('user.edit', $user->id) }}" class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-gray-400 py-6">Tidak ada data user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $users->links() }}</div>
</div>

<style>
    .badge-emerald { background:#10B98120; color:#10B981; padding:2px 12px; border-radius:20px; font-size:12px; display:inline-block; }
    .badge-purple { background:#7C3AED20; color:#A78BFA; padding:2px 12px; border-radius:20px; font-size:12px; display:inline-block; }
    .badge-blue { background:#3B82F620; color:#60A5FA; padding:2px 12px; border-radius:20px; font-size:12px; display:inline-block; }
    .badge-gray { background:#64748B30; color:#94A3B8; padding:2px 12px; border-radius:20px; font-size:12px; display:inline-block; }
</style>
@endsection
