@extends('layouts.app')

@section('title', 'Detail Aset')
@section('subtitle', 'Informasi lengkap dan riwayat aset')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <a href="{{ route('assets.index') }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800 mb-6 transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Daftar Aset</span>
    </a>

    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden card-hover">
        
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 px-8 py-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">👁️</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Detail Aset</h2>
                    <p class="text-blue-100 text-sm mt-1">Informasi lengkap dan riwayat inventaris</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('assets.edit', $asset->id) }}" class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white text-sm rounded-xl hover:bg-white/30 transition-all duration-300 font-semibold flex items-center gap-2">
                    <span>✏️</span> Edit
                </a>
                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('⚠️ Yakin ingin menghapus aset ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-xl transition-all duration-300 font-semibold flex items-center gap-2">
                        <span>🗑️</span> Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="p-8">
            <!-- Asset Header -->
            <div class="flex items-center gap-4 mb-8 p-6 bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl border-2 border-purple-200">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-blue-500 rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-xl">
                    {{ substr($asset->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $asset->name }}</h3>
                    <p class="text-gray-500 text-sm mt-1 font-mono">SN: {{ $asset->serial_number }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-6 rounded-2xl border border-blue-200">
                    <label class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">📦</span> Nama Barang
                    </label>
                    <p class="text-gray-900 font-bold text-lg">{{ $asset->name }}</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-200">
                    <label class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">🔢</span> Nomor Seri
                    </label>
                    <p class="text-gray-900 font-bold text-lg font-mono">{{ $asset->serial_number }}</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-2xl border border-green-200">
                    <label class="block text-sm font-semibold text-green-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">📍</span> Lokasi Penyimpanan
                    </label>
                    <p class="text-gray-900 font-bold text-lg">{{ $asset->location }}</p>
                </div>

                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-6 rounded-2xl border border-yellow-200">
                    <label class="block text-sm font-semibold text-yellow-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">🏷️</span> Status Kondisi
                    </label>
                    <span class="inline-block px-4 py-2 rounded-xl text-sm font-bold shadow-md
                        {{ $asset->status == 'available' ? 'bg-green-500 text-white' : 
                           ($asset->status == 'broken' ? 'bg-red-500 text-white' : 
                           ($asset->status == 'in_use' ? 'bg-yellow-500 text-white' : 'bg-blue-500 text-white')) }}">
                        {{ strtoupper(str_replace('_', ' ', $asset->status)) }}
                    </span>
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-50 to-slate-50 p-6 rounded-2xl border border-gray-200 mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="text-lg">📄</span> Deskripsi Lengkap
                </label>
                <p class="text-gray-900 leading-relaxed">{{ $asset->description ?: 'Tidak ada deskripsi tambahan' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-6 rounded-2xl border border-indigo-200">
                    <label class="block text-sm font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">📅</span> Tanggal Dibuat
                    </label>
                    <p class="text-gray-900 font-bold">{{ $asset->created_at->format('d M Y, H:i') }} WIB</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $asset->created_at->diffForHumans() }}</p>
                </div>

                <div class="bg-gradient-to-br from-violet-50 to-purple-50 p-6 rounded-2xl border border-violet-200">
                    <label class="block text-sm font-semibold text-violet-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">🔄</span> Terakhir Diupdate
                    </label>
                    <p class="text-gray-900 font-bold">{{ $asset->updated_at->format('d M Y, H:i') }} WIB</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $asset->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
