@extends('layouts.app')

@section('title', 'Tambah Aset Baru')
@section('subtitle', 'Daftarkan aset baru ke dalam sistem inventaris')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <a href="{{ route('assets.index') }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800 mb-6 transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="font-medium">Kembali ke Daftar Aset</span>
    </a>

    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden card-hover">
        
        <div class="bg-gradient-to-r from-purple-500 to-blue-500 px-8 py-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">📝</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Formulir Input Aset</h2>
                    <p class="text-purple-100 text-sm mt-1">Isi data aset dengan lengkap dan benar untuk inventarisasi</p>
                </div>
            </div>
        </div>

        <form action="{{ route('assets.store') }}" method="POST" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Nama Barang -->
                <div class="group">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">📦</span>
                        Nama Barang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm focus:ring-4 focus:ring-purple-200 focus:border-purple-500 outline-none transition-all duration-300 @error('name') border-red-500 ring-4 ring-red-200 @enderror" 
                        placeholder="Contoh: Macbook Pro M1 13 inch">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Serial Number -->
                <div class="group">
                    <label for="serial_number" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">🔢</span>
                        Nomor Seri (Unique) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number') }}" 
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm font-mono focus:ring-4 focus:ring-purple-200 focus:border-purple-500 outline-none transition-all duration-300 @error('serial_number') border-red-500 ring-4 ring-red-200 @enderror" 
                        placeholder="Contoh: SN-2025-001">
                    @error('serial_number')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div class="group">
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">📍</span>
                        Lokasi Penyimpanan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                        class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm focus:ring-4 focus:ring-purple-200 focus:border-purple-500 outline-none transition-all duration-300 @error('location') border-red-500 ring-4 ring-red-200 @enderror" 
                        placeholder="Contoh: Ruang Meeting Lantai 2">
                    @error('location')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="group">
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="text-lg">🏷️</span>
                        Status Kondisi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="status" id="status" class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm focus:ring-4 focus:ring-purple-200 focus:border-purple-500 outline-none transition-all duration-300 appearance-none bg-white cursor-pointer">
                            <option value="" disabled selected>-- Pilih Status Aset --</option>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>✅ Available - Tersedia untuk digunakan</option>
                            <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>🔄 In Use - Sedang dipakai</option>
                            <option value="broken" {{ old('status') == 'broken' ? 'selected' : '' }}>❌ Broken - Rusak/tidak berfungsi</option>
                            <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance - Dalam perbaikan</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-purple-500">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                    @error('status')
                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <span class="text-lg">📄</span>
                    Deskripsi Tambahan <span class="text-gray-400 text-xs">(Opsional)</span>
                </label>
                <textarea name="description" id="description" rows="4" 
                    class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 text-sm focus:ring-4 focus:ring-purple-200 focus:border-purple-500 outline-none transition-all duration-300 resize-none" 
                    placeholder="Tambahkan detail seperti: warna, spesifikasi lengkap, kondisi fisik, atau catatan khusus lainnya...">{{ old('description') }}</textarea>
                <p class="text-xs text-gray-400 mt-2">💡 Tips: Semakin detail informasi, semakin mudah pengelolaan aset</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-4 pt-8 border-t-2 border-gray-100">
                <a href="{{ route('assets.index') }}" class="px-6 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 transition-all duration-300 border-2 border-gray-200">
                    ❌ Batal
                </a>
                <button type="submit" class="group px-8 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-purple-500 to-blue-500 hover:shadow-2xl hover:shadow-purple-500/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                    <span class="text-xl group-hover:scale-110 transition-transform">💾</span>
                    <span>Simpan Aset Baru</span>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection