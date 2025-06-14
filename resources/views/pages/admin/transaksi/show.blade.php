@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">📋 Detail Transaksi</h1>
                    <p class="text-red-100 text-lg">#{{ $transaksi->id_transaksi_222336 }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Status Badge -->
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <span
                            class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full 
                            @if ($transaksi->status_222336 == 'selesai') bg-green-100 text-green-800 border border-green-200
                            @elseif($transaksi->status_222336 == 'dikirim') 
                                bg-purple-100 text-purple-800 border border-purple-200
                            @elseif($transaksi->status_222336 == 'dikemas') 
                                bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($transaksi->status_222336 == 'pending') 
                                bg-blue-100 text-blue-800 border border-blue-200
                            @else 
                                bg-gray-100 text-gray-800 border border-gray-200 @endif">
                            {{ ucfirst($transaksi->status_222336) }}
                        </span>
                    </div>
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="bg-white/20 backdrop-blur-sm text-white font-semibold px-6 py-3 rounded-lg hover:bg-white/30 shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Transaction Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Informasi Transaksi
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">ID Transaksi</p>
                                        <p class="text-lg font-bold text-gray-900">#{{ $transaksi->id_transaksi_222336 }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Tanggal Transaksi</p>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('l, d F Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('H:i') }}
                                            WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Total Harga</p>
                                        <p class="text-2xl font-bold text-red-600">
                                            Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Status Transaksi</p>
                                        <div class="mt-2">
                                            <span
                                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                                @if ($transaksi->status_222336 == 'selesai') bg-green-100 text-green-800 border border-green-200
                                                @elseif($transaksi->status_222336 == 'dikirim') 
                                                    bg-purple-100 text-purple-800 border border-purple-200
                                                @elseif($transaksi->status_222336 == 'dikemas') 
                                                    bg-yellow-100 text-yellow-800 border border-yellow-200
                                                @elseif($transaksi->status_222336 == 'pending') 
                                                    bg-blue-100 text-blue-800 border border-blue-200
                                                @else 
                                                    bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                                {{ ucfirst($transaksi->status_222336) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Info Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Pelanggan
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($transaksi->pelanggan)
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 font-bold text-xl">
                                        {{ strtoupper(substr($transaksi->pelanggan->nama_pelanggan_222336, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900">
                                        {{ $transaksi->pelanggan->nama_pelanggan_222336 }}</h4>
                                    <p class="text-gray-600">{{ $transaksi->pelanggan->email_222336 }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Email</p>
                                        <p class="text-gray-900 font-semibold">{{ $transaksi->pelanggan->email_222336 }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 bg-red-600 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Telepon</p>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $transaksi->pelanggan->telepon_222336 ?? 'Tidak ada' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Data pelanggan tidak ditemukan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden sticky top-8">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                        <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Informasi Produk
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($transaksi->produk)
                            <!-- Product Image -->
                            <div class="mb-6">
                                @if ($transaksi->produk->path_img_222336)
                                    <img src="{{ asset('storage/' . $transaksi->produk->path_img_222336) }}"
                                        alt="{{ $transaksi->produk->nama_produk_222336 }}"
                                        class="w-full h-48 object-cover rounded-lg shadow-md">
                                @else
                                    <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-gray-500">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ $transaksi->produk->nama_produk_222336 }}</h4>
                                    @if ($transaksi->produk->deskripsi_222336)
                                        <p class="text-gray-600 text-sm">{{ $transaksi->produk->deskripsi_222336 }}</p>
                                    @endif
                                </div>

                                <div class="border-t pt-4 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Harga Satuan:</span>
                                        <span class="font-semibold text-gray-900">Rp
                                            {{ number_format($transaksi->produk->harga_222336, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Jumlah:</span>
                                        <span class="font-semibold text-gray-900">{{ $transaksi->jumlah_222336 ?? 1 }}
                                            item</span>
                                    </div>
                                    <div class="border-t pt-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-lg font-semibold text-gray-900">Total:</span>
                                            <span class="text-xl font-bold text-red-600">
                                                Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if ($transaksi->produk->kategori_222336)
                                    <div class="mt-4">
                                        <span
                                            class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $transaksi->produk->kategori_222336 }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500">Data produk tidak ditemukan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('admin.transaksi.index') }}"
                class="bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold px-8 py-3 rounded-lg shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Transaksi
            </a>
            <a href="{{ route('admin.laporan') }}"
                class="bg-red-600 text-white hover:bg-red-700 font-semibold px-8 py-3 rounded-lg shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a4 4 0 01-4-4V5a4 4 0 014-4h10a4 4 0 014 4v14a4 4 0 01-4 4z"></path>
                </svg>
                Lihat Laporan
            </a>
        </div>
    </div>
@endsection
