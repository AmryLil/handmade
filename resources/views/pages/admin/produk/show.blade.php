@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-t-2xl shadow-xl">
                <div class="px-8 py-12">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">Detail Produk</h1>
                            <p class="text-red-100 text-lg">Informasi lengkap tentang produk</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.produk.edit', $produk) }}"
                                class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-semibold py-3 px-6 rounded-xl border border-white/30 transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.produk.index') }}"
                                class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-semibold py-3 px-6 rounded-xl border border-white/30 transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-b-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Product Image -->
                        <div class="space-y-6">
                            <div class="relative">
                                @if ($produk->path_img_222336)
                                    <div
                                        class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden shadow-lg">
                                        <img src="{{ $produk->getImageUrlAttribute() }}" alt="{{ $produk->nama_222336 }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center shadow-lg">
                                        <div class="text-center">
                                            <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-gray-500 font-medium">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="space-y-8">
                            <!-- Product Name & Category -->
                            <div class="space-y-4">
                                <h2 class="text-3xl font-bold text-gray-900">{{ $produk->nama_222336 }}</h2>
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        {{ $produk->kategori->nama_222336 ?? 'Tidak Ada Kategori' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Price & Stock -->
                            <div class="grid grid-cols-2 gap-6">
                                <div
                                    class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-3 bg-green-500 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-green-600">Harga</p>
                                            <p class="text-2xl font-bold text-green-800">
                                                Rp{{ number_format($produk->harga_222336, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border border-blue-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-3 bg-blue-500 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-blue-600">Stok</p>
                                            <p class="text-2xl font-bold text-blue-800">{{ $produk->jumlah_222336 }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Info Cards -->
                            <div class="space-y-4">
                                <div
                                    class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-2xl border border-gray-200">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="p-2 bg-gray-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-800">ID Produk</h3>
                                    </div>
                                    <p class="text-gray-700 font-mono text-lg">{{ $produk->id_222336 }}</p>
                                </div>

                                <div
                                    class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-2xl border border-purple-200">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="p-2 bg-purple-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-800">Terakhir Diperbarui</h3>
                                    </div>
                                    <p class="text-gray-700 text-lg">{{ $produk->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            <!-- Description -->
                            @if ($produk->deskripsi_222336)
                                <div
                                    class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 rounded-2xl border border-amber-200">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="p-2 bg-amber-500 rounded-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-800">Deskripsi Produk</h3>
                                    </div>
                                    <div class="prose prose-gray max-w-none">
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                            {{ $produk->deskripsi_222336 }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border-2 border-red-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-50 to-red-100 px-8 py-6 border-b border-red-200">
                    <h3 class="text-xl font-bold text-red-800 flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        <span>Zona Berbahaya</span>
                    </h3>
                    <p class="text-red-600 mt-2">Tindakan di bawah ini tidak dapat dibatalkan</p>
                </div>
                <div class="p-8">
                    <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan!');">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Hapus Produk</h4>
                                <p class="text-gray-600 mt-1">Menghapus produk akan menghilangkan semua data terkait secara
                                    permanen.</p>
                            </div>
                            <button type="submit"
                                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-8 rounded-xl shadow-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Hapus Produk</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
