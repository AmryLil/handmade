<!-- resources/views/kategori/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Kategori Produk
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Temukan berbagai pilihan produk berkualitas sesuai kategori
                </p>
            </div>

            <!-- Kategori Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @forelse ($kategori as $item)
                    <div
                        class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200 transition-all hover:shadow-md">
                        <div class="relative pb-2/3">
                            @if ($item->path_img_2222336)
                                <img src="{{ asset('storage/' . $item->path_img_2222336) }}" alt="{{ $item->nama_2222336 }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->nama_2222336 }}</h3>

                                <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                                    {{ $item->deskripsi_2222336 ?: 'Tidak ada deskripsi' }}
                                </p>

                                @if ($item->tags_2222336)
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach (explode(',', $item->tags_2222336) as $tag)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-50 text-red-700">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <a href="{{ route('kategori.show', $item->id_2222336) }}"
                                    class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada kategori</h3>
                        <p class="mt-1 text-gray-500">Belum ada kategori produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
