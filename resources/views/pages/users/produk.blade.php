@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="container mx-auto px-4 py-8">
            <!-- Enhanced Breadcrumb -->
            <nav class="flex mb-8 bg-white/70 backdrop-blur-sm rounded-xl p-4 shadow-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-slate-600 hover:text-maroon-600 font-medium">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.index') }}"
                                class="text-slate-600 hover:text-maroon-600 font-medium">
                                Produk
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.category', $product->kategori->id_222336) }}"
                                class="text-slate-600 hover:text-maroon-600 font-medium">
                                {{ $product->kategori->nama_222336 }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-slate-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-500 font-medium truncate max-w-xs">{{ $product->nama_222336 }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Product Detail Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-200/50">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Product Images Section -->
                    <div class="p-8 bg-gradient-to-br from-slate-50 to-white">
                        <div class="sticky top-8">
                            <div class="mb-6">
                                @if ($product->path_img_222336)
                                    <img id="mainImage" src="{{ $product->getImageUrlAttribute() }}"
                                        alt="{{ $product->nama_222336 }}"
                                        class="w-full h-96 object-cover rounded-xl shadow-lg">
                                @else
                                    <div
                                        class="w-full h-96 bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center rounded-xl shadow-lg">
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
                            </div>

                            @if ($product->gambar && $product->gambar->count() > 0)
                                <div class="grid grid-cols-4 gap-3">
                                    @foreach ($product->gambar as $gambar)
                                        <img src="{{ Storage::url($gambar->path_img_222336) }}"
                                            alt="{{ $product->nama_222336 }}"
                                            class="gallery-thumb h-20 w-full object-cover rounded-lg cursor-pointer hover:ring-2 hover:ring-maroon-500 hover:ring-offset-2 shadow-md">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info Section -->
                    <div class="p-8 lg:p-12">
                        <div class="space-y-6">
                            <!-- Product Title and Category -->
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <span class=" text-white bg-slate-900 px-4 py-2 rounded-full text-sm font-semibold">
                                        {{ $product->kategori->nama_222336 }}
                                    </span>
                                    <span class="text-slate-400 text-sm font-mono">ID: {{ $product->id_222336 }}</span>
                                </div>
                                <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 leading-tight">
                                    {{ $product->nama_222336 }}</h1>
                            </div>

                            <!-- Price -->
                            <div class="bg-gradient-to-r from-maroon-50 to-red-50 rounded-xl p-6 border border-maroon-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-slate-600 font-medium">Harga</p>
                                        <p class="text-3xl font-bold text-maroon-700">
                                            Rp {{ number_format($product->harga_222336, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-slate-600 font-medium">Stok</p>
                                        @if ($product->jumlah_222336 > 10)
                                            <p class="text-xl font-bold text-green-600">{{ $product->jumlah_222336 }} pcs
                                            </p>
                                            <span
                                                class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-semibold">Tersedia</span>
                                        @elseif($product->jumlah_222336 > 0)
                                            <p class="text-xl font-bold text-amber-600">{{ $product->jumlah_222336 }} pcs
                                            </p>
                                            <span
                                                class="inline-block bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full font-semibold">Terbatas</span>
                                        @else
                                            <p class="text-xl font-bold text-red-600">0 pcs</p>
                                            <span
                                                class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold">Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="bg-slate-50 rounded-xl p-6">
                                <h3 class="text-lg font-semibold text-slate-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-maroon-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Deskripsi Produk
                                </h3>
                                <p class="text-slate-700 leading-relaxed whitespace-pre-line">
                                    {{ $product->deskripsi_222336 }}</p>
                            </div>

                            <!-- Add to Cart Form -->
                            @auth
                                @if ($product->jumlah_222336 > 0)
                                    <div class="bg-white border-2 border-maroon-100 rounded-xl p-6">
                                        <form id="addToCartForm" class="space-y-4">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id_222336 }}">

                                            <!-- Quantity Selector -->
                                            <div class="flex items-center justify-between">
                                                <label for="quantity"
                                                    class="text-lg font-semibold text-slate-900">Jumlah:</label>
                                                <div class="flex items-center bg-slate-100 rounded-lg overflow-hidden">
                                                    <button type="button" id="decrementBtn"
                                                        class="px-4 py-3 text-slate-600 hover:bg-slate-200 font-bold text-lg">−</button>
                                                    <input type="number" name="quantity" id="quantity" value="1"
                                                        min="1" max="{{ $product->jumlah_222336 }}"
                                                        class="w-16 py-3 text-center border-0 bg-transparent focus:ring-0 focus:outline-none font-bold text-lg [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                                    <button type="button" id="incrementBtn"
                                                        class="px-4 py-3 text-slate-600 hover:bg-slate-200 font-bold text-lg">+</button>
                                                </div>
                                            </div>

                                            <!-- Add to Cart Button -->
                                            <button type="submit" id="addToCartBtn"
                                                class="w-full bg-slate-900 text-white py-4 px-6 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl flex items-center justify-center space-x-3 transition-all duration-200 hover:bg-slate-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span id="btnText">Tambah ke Keranjang</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="bg-slate-100 rounded-xl p-6 text-center">
                                        <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                            </path>
                                        </svg>
                                        <p class="text-slate-600 font-semibold">Produk sedang tidak tersedia</p>
                                        <p class="text-slate-500 text-sm mt-1">Silakan cek kembali nanti</p>
                                    </div>
                                @endif
                            @else
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
                                    <svg class="w-12 h-12 text-blue-500 mx-auto mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <p class="text-blue-800 font-semibold mb-2">Login diperlukan</p>
                                    <p class="text-blue-600 text-sm mb-4">Silakan login terlebih dahulu untuk menambahkan ke
                                        keranjang</p>
                                    <a href="{{ route('login') }}"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-semibold transition-colors duration-200">
                                        Login Sekarang
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl border border-slate-200 p-4 max-w-sm">
            <div class="flex items-center">
                <div id="toastIcon" class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p id="toastMessage" class="text-sm font-semibold text-slate-900"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const addToCartForm = document.getElementById('addToCartForm');
            const addToCartBtn = document.getElementById('addToCartBtn');
            const btnText = document.getElementById('btnText');
            const maxQuantity = {{ $product->jumlah_222336 }};

            // Only initialize cart functionality if user is authenticated and form exists
            if (addToCartForm) {
                // Quantity controls
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

                // Add to cart functionality
                addToCartForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const originalBtnText = btnText.textContent;

                    // Update button state
                    addToCartBtn.disabled = true;
                    btnText.textContent = 'Menambahkan...';
                    addToCartBtn.classList.add('opacity-75');

                    // Get CSRF token from meta tag or form
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') ||
                        document.querySelector('input[name="_token"]')?.value ||
                        '{{ csrf_token() }}';

                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: formData.get('product_id'),
                                quantity: parseInt(formData.get('quantity'))
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                showToast(data.message, 'success');
                                // Update cart count if you have a cart counter in your layout
                                updateCartCount();
                            } else if (data.error) {
                                showToast(data.error, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
                        })
                        .finally(() => {
                            // Reset button state
                            addToCartBtn.disabled = false;
                            btnText.textContent = originalBtnText;
                            addToCartBtn.classList.remove('opacity-75');
                        });
                });
            }

            // Gallery image switching
            const galleryImages = document.querySelectorAll('.gallery-thumb');
            const mainImage = document.getElementById('mainImage');

            if (galleryImages.length > 0 && mainImage) {
                galleryImages.forEach(img => {
                    img.addEventListener('click', function() {
                        mainImage.src = this.src;
                        // Remove active state from all thumbnails
                        galleryImages.forEach(thumb => thumb.classList.remove('ring-2',
                            'ring-maroon-500', 'ring-offset-2'));
                        // Add active state to clicked thumbnail
                        this.classList.add('ring-2', 'ring-maroon-500', 'ring-offset-2');
                    });
                });
            }

            // Toast notification function
            function showToast(message, type) {
                const toast = document.getElementById('toast');
                const toastIcon = document.getElementById('toastIcon');
                const toastMessage = document.getElementById('toastMessage');

                toastMessage.textContent = message;

                if (type === 'success') {
                    toastIcon.classList.remove('bg-red-100', 'text-red-600');
                    toastIcon.classList.add('bg-green-100', 'text-green-600');
                } else {
                    toastIcon.classList.remove('bg-green-100', 'text-green-600');
                    toastIcon.classList.add('bg-red-100', 'text-red-600');
                }

                toast.classList.remove('hidden');

                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 3000);
            }

            // Update cart count function (implement based on your layout)
            function updateCartCount() {
                // Check if cart summary route exists
                @if (Route::has('cart.summary'))
                    fetch('{{ route('cart.summary') }}', {
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Update cart count display if you have one
                            const cartCountElements = document.querySelectorAll('.cart-count');
                            cartCountElements.forEach(el => {
                                el.textContent = data.item_count || 0;
                            });
                        })
                        .catch(error => console.error('Error updating cart count:', error));
                @endif
            }
        });
    </script>
@endsection
