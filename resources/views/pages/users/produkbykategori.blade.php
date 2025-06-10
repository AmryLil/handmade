<!-- resources/views/kategori/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('kategori.index') }}" class="text-gray-500 hover:text-gray-700">
                            Kategori
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-800 font-medium">{{ $kategori->nama_222336 }}</span>
                    </li>
                </ol>
            </nav>

            <!-- Kategori Header -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 mb-8">
                <div class="md:flex">
                    <div class="md:flex-shrink-0">
                        @if ($kategori->path_img_222336)
                            <img src="{{ asset($kategori->path_img_222336) }}" alt="{{ $kategori->nama_222336 }}"
                                class="h-64 w-full object-cover md:w-64">
                        @else
                            <div class="h-64 w-full md:w-64 bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="uppercase tracking-wide text-sm text-red-600 font-semibold">Kategori</div>
                        <h1 class="mt-1 text-2xl font-bold text-gray-900">{{ $kategori->nama_222336 }}</h1>
                        <p class="mt-3 text-gray-600">
                            {{ $kategori->deskripsi_222336 ?: 'Tidak ada deskripsi untuk kategori ini.' }}
                        </p>

                        @if ($kategori->tags_222336)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach (explode(',', $kategori->tags_222336) as $tag)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Produk dalam Kategori -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Produk dalam Kategori</h2>

                @if ($kategori->produk->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($kategori->produk as $produk)
                            <div
                                class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 transition-all hover:shadow-md">
                                <div class="relative">
                                    @if ($produk->path_img_222336)
                                        <img src="{{ $produk->getImageUrlAttribute() }}" alt="{{ $produk->nama_222336 }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M20 7l-8-4-8 4m16 0v10l-8 4m-8-4V7m16 10l-8 4m-8-4l8 4" />
                                            </svg>
                                        </div>
                                    @endif

                                    @if ($produk->diskon_222336 > 0)
                                        <div class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded">
                                            Diskon {{ $produk->diskon_222336 }}%
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $produk->nama_222336 }}</h3>

                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                        {{ $produk->deskripsi_222336 }}
                                    </p>

                                    <div class="mt-3">
                                        @if ($produk->diskon_222336 > 0)
                                            <div class="flex items-baseline">
                                                <span class="text-lg font-bold text-red-600">
                                                    Rp
                                                    {{ number_format(($produk->harga_222336 * (100 - $produk->diskon_222336)) / 100, 0, ',', '.') }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500 line-through">
                                                    Rp {{ number_format($produk->harga_222336, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-lg font-bold text-gray-900">
                                                Rp {{ number_format($produk->harga_222336, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4">
                                        <a href="#"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white py-12 px-6 rounded-lg shadow-sm border border-gray-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada produk</h3>
                        <p class="mt-1 text-gray-500">Belum ada produk yang tersedia dalam kategori ini.</p>
                    </div>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-8">
                <a href="{{ route('kategori.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Kategori
                </a>
            </div>
        </div>
    </div>
@endsection
