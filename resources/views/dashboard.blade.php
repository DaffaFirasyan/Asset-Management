@extends('layouts.app')

@section('title', 'Dashboard Monitoring')
@section('subtitle', 'Pantau statistik dan aktivitas aset secara real-time')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Aset -->
        <div class="card-hover bg-white p-6 rounded-2xl shadow-lg border-l-4 border-blue-500 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm font-medium text-gray-500">Total Aset</div>
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">📊</span>
                    </div>
                </div>
                <div class="text-4xl font-bold text-gray-800">{{ $total }}</div>
                <div class="text-xs text-gray-400 mt-2">Seluruh inventaris</div>
            </div>
        </div>

        <!-- Tersedia -->
        <div class="card-hover bg-white p-6 rounded-2xl shadow-lg border-l-4 border-green-500 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-20 h-20 bg-green-500/10 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm font-medium text-gray-500">Tersedia</div>
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">✅</span>
                    </div>
                </div>
                <div class="text-4xl font-bold text-green-600">{{ $available }}</div>
                <div class="text-xs text-gray-400 mt-2">Siap digunakan</div>
            </div>
        </div>

        <!-- Sedang Dipakai -->
        <div class="card-hover bg-white p-6 rounded-2xl shadow-lg border-l-4 border-yellow-500 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-500/10 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm font-medium text-gray-500">Sedang Dipakai</div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">🔄</span>
                    </div>
                </div>
                <div class="text-4xl font-bold text-yellow-600">{{ $inUse }}</div>
                <div class="text-xs text-gray-400 mt-2">Dalam penggunaan</div>
            </div>
        </div>

        <!-- Rusak -->
        <div class="card-hover bg-white p-6 rounded-2xl shadow-lg border-l-4 border-red-500 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-20 h-20 bg-red-500/10 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-sm font-medium text-gray-500">Rusak</div>
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <span class="text-xl">⚠️</span>
                    </div>
                </div>
                <div class="text-4xl font-bold text-red-600">{{ $broken }}</div>
                <div class="text-xs text-gray-400 mt-2">Perlu perbaikan</div>
            </div>
        </div>
    </div>

    <!-- Recent Assets Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover">
        <div class="bg-gradient-to-r from-purple-500 to-blue-500 px-6 py-5 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-white text-lg flex items-center gap-2">
                    <span class="text-2xl">📦</span>
                    Aset Baru Ditambahkan
                </h3>
                <p class="text-purple-100 text-sm mt-1">5 aset terakhir yang didaftarkan</p>
            </div>
            <a href="{{ route('assets.index') }}" class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-xl hover:bg-white/30 transition text-sm font-medium">
                Lihat Semua →
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-purple-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 font-semibold">#</th>
                        <th class="px-6 py-4 font-semibold">Nama Barang</th>
                        <th class="px-6 py-4 font-semibold">Lokasi</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Ditambahkan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentAssets as $index => $asset)
                    <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 transition-all duration-300">
                        <td class="px-6 py-4 text-gray-500 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr($asset->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-gray-800">{{ $asset->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <div class="flex items-center gap-2">
                                <span>📍</span>
                                {{ $asset->location }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm
                                {{ $asset->status == 'available' ? 'bg-green-100 text-green-700 border border-green-200' : 
                                  ($asset->status == 'broken' ? 'bg-red-100 text-red-700 border border-red-200' : 
                                  ($asset->status == 'in_use' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : 'bg-blue-100 text-blue-700 border border-blue-200')) }}">
                                {{ strtoupper(str_replace('_', ' ', $asset->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">
                            {{ $asset->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($recentAssets->isEmpty())
        <div class="p-12 text-center">
            <div class="text-6xl mb-4">📦</div>
            <p class="text-gray-500 text-lg font-medium">Belum ada aset terdaftar</p>
            <p class="text-gray-400 text-sm mt-2">Mulai tambahkan aset baru untuk memulai</p>
            <a href="{{ route('assets.create') }}" class="inline-block mt-4 px-6 py-3 bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-xl hover:shadow-lg transition font-medium">
                + Tambah Aset Pertama
            </a>
        </div>
        @endif
    </div>
@endsection