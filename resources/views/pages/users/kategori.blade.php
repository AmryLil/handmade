<!-- resources/views/kategori/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-100">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-red-600 via-red-700 to-rose-800">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">
                        Kategori <span class="text-red-200">Produk</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto font-light leading-relaxed">
                        Jelajahi koleksi terlengkap dengan berbagai pilihan produk berkualitas premium yang telah dikurasi
                        khusus untuk Anda
                    </p>
                    <div class="mt-8 flex justify-center">
                        <div class="h-1 w-32 bg-gradient-to-r from-red-200 to-white rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mt-12 -mr-12 w-48 h-48 bg-white opacity-5 rounded-full"></div>
            <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-white opacity-5 rounded-full"></div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            @forelse ($kategori as $index => $item)
                <!-- Full Width Category Card -->
                <div class="mb-8 group">
                    <div
                        class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-red-200 transition-all duration-300">
                        <div class="flex flex-col lg:flex-row {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : '' }}">
                            <!-- Image Section -->
                            <div class="lg:w-2/5 relative overflow-hidden">
                                @if ($item->path_img_222336)
                                    <img src="{{ asset('storage/' . $item->path_img_222336) }}"
                                        alt="{{ $item->nama_222336 }}"
                                        class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div
                                        class="w-full h-64 lg:h-80 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center group-hover:from-red-50 group-hover:to-red-100 transition-all duration-300">
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-24 w-24 text-gray-300 group-hover:text-red-300 transition-colors duration-300 mx-auto mb-4"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-gray-400 font-medium">Gambar Kategori</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>


                            </div>

                            <!-- Content Section -->
                            <div class="lg:w-3/5 p-8 lg:p-12 flex flex-col justify-center">
                                <div class="space-y-6">
                                    <!-- Category Title -->
                                    <div>
                                        <h2
                                            class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3 group-hover:text-red-700 transition-colors duration-300">
                                            {{ $item->nama_222336 }}
                                        </h2>
                                        <div class="h-1 w-20 bg-gradient-to-r from-red-600 to-red-400 rounded-full"></div>
                                    </div>

                                    <!-- Description -->
                                    <div class="space-y-4">
                                        <p class="text-gray-600 text-lg leading-relaxed font-light">
                                            {{ $item->deskripsi_222336 ?: 'Temukan berbagai produk berkualitas dalam kategori ini yang telah dipilih khusus untuk memenuhi kebutuhan dan preferensi Anda.' }}
                                        </p>
                                    </div>

                                    <!-- Tags -->
                                    @if ($item->tags_222336)
                                        <div class="flex flex-wrap gap-3">
                                            @foreach (explode(',', $item->tags_222336) as $tag)
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-50 to-rose-50 text-red-700 border border-red-100 hover:bg-gradient-to-r hover:from-red-100 hover:to-rose-100 transition-all duration-200">
                                                    <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ trim($tag) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Action Button -->
                                    <div class="pt-4">
                                        <a href="{{ route('kategori.show', $item->id_222336) }}"
                                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 group">
                                            <span class="mr-3">Jelajahi Produk</span>
                                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>

                                    <!-- Stats or Additional Info -->
                                    <div class="pt-6 border-t border-gray-100">
                                        <div class="flex items-center space-x-8 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                                                    </path>
                                                </svg>
                                                <span>Kategori Premium</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span>Kualitas Terjamin</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <!-- Empty State Illustration -->
                        <div
                            class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Kategori</h3>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            Kategori produk sedang dalam tahap persiapan. Silakan kembali lagi nanti untuk melihat koleksi
                            terbaru kami.
                        </p>

                        <!-- Call to Action -->
                        <div class="bg-gradient-to-r from-red-50 to-rose-50 rounded-xl p-6 border border-red-100">
                            <h4 class="font-semibold text-red-900 mb-2">Tetap Update!</h4>
                            <p class="text-red-700 text-sm">Kategori baru akan segera hadir dengan produk-produk pilihan
                                terbaik.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Bottom Decoration -->
        <div class="mt-20 bg-gradient-to-r from-red-600 to-red-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <div class="inline-flex items-center space-x-2 text-red-100">
                        <div class="w-2 h-2 bg-red-200 rounded-full"></div>
                        <div class="w-2 h-2 bg-red-300 rounded-full"></div>
                        <div class="w-2 h-2 bg-red-200 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
