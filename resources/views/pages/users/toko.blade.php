@extends('layouts.app')

@section('title', 'List Produk')

@section('content')
    <section class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        <div class="container mx-auto px-4 py-12">
            <!-- Search and filter section -->
            <div class="mb-10 bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <form action="{{ route('products.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center items-end">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-slate-700 mb-3">Cari Produk</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full px-6 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-300 placeholder-slate-400"
                            placeholder="Masukkan nama produk atau deskripsi...">
                    </div>

                    <div class="h-fit">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 px-8 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span>Cari Produk</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results count and category title -->
            @if (request('search') || request('kategori') || request('min_price') || request('max_price'))
                <div class="mb-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border border-white/30">
                        <h2
                            class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                            {{ $products->total() }} Hasil Pencarian
                            @if (request('search'))
                                <span class="text-blue-600">untuk "{{ request('search') }}"</span>
                            @endif
                        </h2>
                    </div>
                </div>
            @else
                <div class="mb-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-xl p-6 border border-white/30">
                        <h2
                            class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                            Semua Produk
                        </h2>
                    </div>
                </div>
            @endif

            <!-- Products grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="group bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 overflow-hidden hover:shadow-2xl hover:scale-105 transition-all duration-300">
                            <div class="relative overflow-hidden">
                                @if ($product->path_img_222336)
                                    <img src="{{ $product->getImageUrlAttribute() }}" alt="{{ $product->nama_222336 }}"
                                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-64 bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                        <div class="text-center">
                                            <svg class="w-16 h-16 text-slate-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-slate-500 font-medium">No Image</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Stock badge -->
                                <div class="absolute top-4 right-4">
                                    @if ($product->jumlah_222336 > 10)
                                        <span
                                            class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            Stok {{ $product->jumlah_222336 }}
                                        </span>
                                    @elseif($product->jumlah_222336 > 0)
                                        <span
                                            class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            Stok {{ $product->jumlah_222336 }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="mb-3">
                                    <span
                                        class="inline-block bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full border border-blue-200">
                                        {{ $product->kategori->nama_222336 }}
                                    </span>
                                </div>

                                <h3
                                    class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $product->nama_222336 }}
                                </h3>

                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">
                                    {{ $product->deskripsi_222336 }}
                                </p>

                                <div class="flex items-center justify-between mb-6">
                                    <div
                                        class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($product->harga_222336, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="flex space-x-3">
                                    <a href="{{ route('products.show', $product->id_222336) }}"
                                        class="flex-1 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white py-3 px-4 rounded-xl font-semibold text-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                        <div class="flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            <span>Detail</span>
                                        </div>
                                    </a>

                                    @if ($product->jumlah_222336 > 0)
                                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id_222336 }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                        </path>
                                                    </svg>
                                                    <span>Keranjang</span>
                                                </div>
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex-1">
                                            <button disabled
                                                class="w-full bg-slate-400 text-white py-3 px-4 rounded-xl font-semibold cursor-not-allowed opacity-60">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                                        </path>
                                                    </svg>
                                                    <span>Stok Habis</span>
                                                </div>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-4">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white/80 backdrop-blur-sm p-12 rounded-2xl shadow-xl text-center border border-white/20">
                    <div class="max-w-md mx-auto">
                        <div
                            class="bg-gradient-to-br from-slate-100 to-slate-200 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Tidak Ada Produk Ditemukan</h3>
                        <p class="text-slate-600 mb-6">Coba ubah filter pencarian Anda atau lihat kategori lainnya.</p>
                        <a href="{{ route('products.index') }}"
                            class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-6 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            Lihat Semua Produk
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50" id="success-message">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50" id="error-message">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        // Auto hide messages after 5 seconds
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.display = 'none';
            }
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000);
    </script>
@endsection
