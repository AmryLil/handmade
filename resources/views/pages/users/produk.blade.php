@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <section class="py-10 bg-blue-50">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-maroon-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.index') }}"
                                class="ml-1 text-gray-700 hover:text-maroon-600 md:ml-2">
                                Produk
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.category', $product->kategori->id_2222336) }}"
                                class="ml-1 text-gray-700 hover:text-maroon-600 md:ml-2">
                                {{ $product->kategori->nama_2222336 }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-gray-500 md:ml-2 truncate max-w-xs">{{ $product->nama_2222336 }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Product Detail -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div class="p-6">
                        <div class="mb-4">
                            @if ($product->path_img_2222336)
                                <img src="{{ $product->getImageUrlAttribute() }}" alt="{{ $product->nama_2222336 }}"
                                    class="w-full h-96 object-cover rounded-lg">
                            @else
                                <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>

                        @if ($product->gambar->count() > 0)
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($product->gambar as $gambar)
                                    <img src="{{ Storage::url($gambar->path_img_2222336) }}"
                                        alt="{{ $product->nama_2222336 }}"
                                        class="h-24 w-full object-cover rounded-lg cursor-pointer hover:opacity-80 transition duration-300">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h1 class="text-3xl font-bold text-slate-900">{{ $product->nama_2222336 }}</h1>

                        <div class="mt-2">
                            <span class="bg-maroon-100 text-maroon-700 px-3 py-1 rounded-full text-sm">
                                {{ $product->kategori->nama_2222336 }}
                            </span>
                            <span class="ml-3 text-sm text-gray-500">ID: {{ $product->id_2222336 }}</span>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-2xl font-bold text-maroon-700">
                                Rp {{ number_format($product->harga_2222336, 0, ',', '.') }}
                            </h2>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Deskripsi Produk</h3>
                            <p class="text-gray-600 whitespace-pre-line">{{ $product->deskripsi_2222336 }}</p>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Stok</h3>
                            <p class="text-gray-600">
                                @if ($product->jumlah_2222336 > 10)
                                    <span class="text-green-600 font-medium">Tersedia
                                        ({{ $product->jumlah_2222336 }})</span>
                                @elseif($product->jumlah_2222336 > 0)
                                    <span class="text-yellow-600 font-medium">Stok Terbatas
                                        ({{ $product->jumlah_2222336 }})</span>
                                @else
                                    <span class="text-red-600 font-medium">Stok Habis</span>
                                @endif
                            </p>
                        </div>

                        @if ($product->jumlah_2222336 > 0)
                            <form action="#" method="POST" class="mt-8">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id_2222336 }}">

                                <div class="flex items-center mb-4">
                                    <label for="quantity" class="block w-24 font-medium text-gray-700">Jumlah:</label>
                                    <div class="flex items-center">
                                        <button type="button"
                                            class="decrement-btn px-3 py-1 bg-gray-200 rounded-l text-gray-700">-</button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                                            max="{{ $product->jumlah_2222336 }}"
                                            class="w-20 py-1 text-center border-y border-gray-300 focus:ring-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button type="button"
                                            class="increment-btn px-3 py-1 bg-gray-200 rounded-r text-gray-700">+</button>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-maroon-700 hover:bg-maroon-800 text-white py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center space-x-2 mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Tambah ke Keranjang</span>
                                </button>
                            </form>
                        @else
                            <button disabled
                                class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg mt-8 cursor-not-allowed">
                                Stok Tidak Tersedia
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            @if ($product->preview->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Ulasan Produk</h2>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="space-y-6">
                            @foreach ($product->preview as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div
                                                class="bg-maroon-100 text-maroon-700 rounded-full h-10 w-10 flex items-center justify-center font-bold">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="font-medium text-gray-900">{{ $review->user->name }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $review->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex text-maroon-500">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating_2222336)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-gray-600">{{ $review->content_2222336 }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Produk Terkait</h2>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                                @if ($relatedProduct->path_img_2222336)
                                    <img src="{{ $relatedProduct->getImageUrlAttribute() }}"
                                        alt="{{ $relatedProduct->nama_2222336 }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-slate-900 truncate">
                                        {{ $relatedProduct->nama_2222336 }}</h3>
                                    <p class="text-maroon-700 font-bold mt-2">Rp
                                        {{ number_format($relatedProduct->harga_2222336, 0, ',', '.') }}</p>
                                    <a href="{{ route('products.show', $relatedProduct->id_2222336) }}"
                                        class="mt-3 block w-full bg-maroon-700 hover:bg-maroon-800 text-white py-2 text-center rounded transition duration-300">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity increment/decrement
            const quantityInput = document.getElementById('quantity');
            const decrementBtn = document.querySelector('.decrement-btn');
            const incrementBtn = document.querySelector('.increment-btn');
            const maxQuantity = {{ $product->jumlah_2222336 }};

            decrementBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            incrementBtn.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < maxQuantity) {
                    quantityInput.value = currentValue + 1;
                }
            });

            // Gallery image switching (if implemented)
            const galleryImages = document.querySelectorAll('.grid-cols-4 img');
            const mainImage = document.querySelector('.h-96');

            galleryImages.forEach(img => {
                img.addEventListener('click', function() {
                    mainImage.src = this.src;
                });
            });
        });
    </script>
@endsection
