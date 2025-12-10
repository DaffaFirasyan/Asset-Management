@extends('layouts.app')
@section('title', 'Manajemen Aset')
@section('subtitle', 'Kelola data inventaris kantor Anda')

@section('content')
    <!-- Header Actions -->
    <div class="mb-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
        <div>
            <p class="text-gray-600 flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
                <span>Total <strong class="text-purple-600">{{ $assets->count() }}</strong> aset terdaftar dalam sistem</span>
            </p>
        </div>
        <a href="{{ route('assets.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-md hover:shadow-md transition-all duration-200 font-medium text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Aset</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-3 rounded-lg mb-5 shadow-sm flex items-center gap-3">
            <div class="w-7 h-7 bg-white/20 rounded-md flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 px-5 py-3.5">
            <h3 class="font-bold text-white text-base flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                Daftar Inventaris Aset
            </h3>
            <p class="text-purple-100 text-xs mt-0.5">Semua aset yang terdaftar dalam sistem</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2.5 font-semibold w-12 text-center">#</th>
                        <th class="px-4 py-2.5 font-semibold">Nama Aset</th>
                        <th class="px-4 py-2.5 font-semibold">Serial Number</th>
                        <th class="px-4 py-2.5 font-semibold">Lokasi</th>
                        <th class="px-4 py-2.5 font-semibold">Status</th>
                        <th class="px-4 py-2.5 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($assets as $index => $item)
                    <tr class="hover:bg-purple-50 transition-colors duration-200">
                        <td class="px-4 py-3 text-gray-500 font-medium text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-sm flex-shrink-0">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-medium text-gray-800 text-sm">{{ $item->name }}</div>
                                    @if($item->description)
                                    <div class="text-xs text-gray-400 truncate">{{ Str::limit($item->description, 40) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2.5 py-1 bg-gray-50 rounded-md text-gray-700 font-mono text-xs border border-gray-200">
                                {{ $item->serial_number }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            <div class="flex items-center gap-1.5">
                                <span class="text-gray-400">📍</span>
                                <span>{{ $item->location }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2.5 py-1 rounded-md text-xs font-semibold
                                {{ $item->status == 'available' ? 'bg-green-50 text-green-700 border border-green-200' : 
                                   ($item->status == 'broken' ? 'bg-red-50 text-red-700 border border-red-200' : 
                                   ($item->status == 'in_use' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-blue-50 text-blue-700 border border-blue-200')) }}">
                                {{ strtoupper(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-1.5">
                                <a href="{{ route('assets.show', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-medium text-xs transition-colors duration-200" title="Lihat Detail">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>Lihat</span>
                                </a>
                                <a href="{{ route('assets.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-md font-medium text-xs transition-colors duration-200" title="Edit Aset">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('assets.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('⚠️ Yakin ingin menghapus aset ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-md font-medium text-xs transition-colors duration-200" title="Hapus Aset">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($assets->isEmpty())
        <div class="p-12 text-center border-t border-gray-100">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Aset</h3>
            <p class="text-gray-500 text-sm mb-6">Mulai tambahkan aset baru untuk memulai inventarisasi</p>
            <a href="{{ route('assets.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold text-sm">
                <span class="text-xl">+</span> 
                <span>Tambah Aset Pertama</span>
            </a>
        </div>
        @endif
    </div>
@endsection