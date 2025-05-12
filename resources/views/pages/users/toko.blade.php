@extends('layouts.app')

@section('title', 'List Produk')

@section('content')
    <section class="py-10 bg-blue-50">
        <div class="container mx-auto px-4">
            <!-- Search and filter section -->
            <div class="mb-8 bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('products.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center items-end">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-maroon-500 focus:border-maroon-500"
                            placeholder="Nama produk atau deskripsi...">
                    </div>





                    <div class="h-fit mb-0.5">
                        <button type="submit"
                            class="w-full   bg-maroon-700 hover:bg-maroon-800 text-white py-2 px-4 rounded transition duration-300 h-full">
                            Cari Produk
                        </button>
                    </div>
                </form>
            </div>

            <!-- Results count and category title -->
            @if (request('search') || request('kategori') || request('min_price') || request('max_price'))
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-slate-900">
                        {{ $products->total() }} Hasil Pencarian
                        @if (request('search'))
                            untuk "{{ request('search') }}"
                        @endif
                    </h2>
                </div>
            @else
                <div class="mb-4">
                    <h2 class="text-2xl font-bold text-slate-900">Semua Produk</h2>
                </div>
            @endif

            <!-- Products grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                            @if ($product->path_img_2222336)
                                <img src="{{ $product->getImageUrlAttribute() }}" alt="{{ $product->nama_2222336 }}"
                                    class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900">{{ $product->nama_2222336 }}</h3>
                                <div class="text-sm text-maroon-500 mt-1">
                                    <span class="bg-maroon-100 text-maroon-700 px-2 py-1 rounded">
                                        {{ $product->kategori->nama_2222336 }}
                                    </span>
                                </div>
                                <p class="text-slate-600 mt-2 line-clamp-2">{{ $product->deskripsi_2222336 }}</p>
                                <p class="text-maroon-700 font-bold text-lg mt-4">Rp
                                    {{ number_format($product->harga_2222336, 0, ',', '.') }}</p>
                                <div class="flex space-x-2 mt-4">
                                    <a href="{{ route('products.show', $product->id_2222336) }}"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-3 rounded transition duration-300 text-center">
                                        Detail
                                    </a>
                                    <form action="#" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id_2222336 }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="w-full bg-maroon-700 hover:bg-maroon-800 text-white py-2 px-3 rounded transition duration-300">
                                            Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mt-4">Tidak Ada Produk Ditemukan</h3>
                    <p class="text-gray-500 mt-2">Coba ubah filter pencarian Anda atau lihat kategori lainnya.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
