@extends('layouts.app')

@section('title', 'Artisan Craft Co.')

@section('content')
    <!-- Hero Banner Section -->
    <section class="relative h-full pt-3">
        <div class="h-[500px] w-full overflow-hidden bg-slate-50">
            <div class="absolute inset-0 bg-gradient-to-r from-maroon-900/70 to-transparent z-10"></div>
            <img src="https://img.freepik.com/free-photo/macrame-arrangement-with-copy-space_23-2149072887.jpg?t=st=1746472154~exp=1746475754~hmac=298358705df63ba5efb9887d127e78a7b3116e0838cf59404b4b626442f6f969&w=1800"
                alt="Handmade Crafts Collection" class="w-full h-full object-cover">
            <div class="absolute inset-0 flex items-center z-20">
                <div class="container mx-auto px-6">
                    <div class="max-w-lg">
                        <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">Kerajinan Tangan Berkualitas
                            Premium
                        </h1>
                        <p class="mt-4 text-slate-100 text-lg">Temukan koleksi unik handmade dari pengrajin lokal terbaik
                        </p>
                        <button
                            class="mt-8 bg-maroon-600 hover:bg-maroon-700 text-white font-medium py-3 px-6 rounded-md transition duration-300">
                            Belanja Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Produk Unggulan</h2>
                <p class="text-maroon-600 mt-2">Karya terbaik dari pengrajin kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://img.freepik.com/free-photo/close-up-kitted-bag-still-life_23-2150709525.jpg?t=st=1746472223~exp=1746475823~hmac=c75a43902a23829cc6852dbee5a94ebd619e808786a7cc8e0f8ee28cfcc30d38&w=740"
                        alt="Tas Rajut Handmade" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900">Tas Rajut Eksklusif</h3>
                        <div class="flex text-maroon-500 mt-1">
                            ★★★★★
                        </div>
                        <p class="text-slate-600 mt-2">Tas rajut premium dengan desain unik dan bahan berkualitas tinggi.
                        </p>
                        <p class="text-maroon-700 font-bold text-lg mt-4">Rp 350.000</p>
                        <button
                            class="mt-4 w-full bg-maroon-700 hover:bg-maroon-800 text-white py-2 rounded transition duration-300">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://img.freepik.com/free-photo/jewellery-bangle-background-with-place-text-banner-fashion-accessories_460848-13242.jpg?t=st=1746472279~exp=1746475879~hmac=6883d434798a79305477c970c44627f70cc70bf0dd532c6aee6646728dabf443&w=900"
                        alt="Gelang Etnik" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900">Gelang Etnik Tradisional</h3>
                        <div class="flex text-maroon-500 mt-1">
                            ★★★★★
                        </div>
                        <p class="text-slate-600 mt-2">Gelang etnik dengan motif khas daerah dan manik-manik pilihan.</p>
                        <p class="text-maroon-700 font-bold text-lg mt-4">Rp 125.000</p>
                        <button
                            class="mt-4 w-full bg-maroon-700 hover:bg-maroon-800 text-white py-2 rounded transition duration-300">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl">
                    <img src="https://img.freepik.com/free-photo/handcrafted-wooden-decorative-round-sculpture_23-2151003056.jpg?t=st=1746472332~exp=1746475932~hmac=498c91279bfbb04fe6ffd583064d93c6c84e78ed3e2327a09653bce572a215b9&w=1800"
                        alt="Hiasan Dinding" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900">Hiasan Dinding Macramé</h3>
                        <div class="flex text-maroon-500 mt-1">
                            ★★★★☆
                        </div>
                        <p class="text-slate-600 mt-2">Hiasan dinding artistik dengan teknik macramé yang rumit.</p>
                        <p class="text-maroon-700 font-bold text-lg mt-4">Rp 275.000</p>
                        <button
                            class="mt-4 w-full bg-maroon-700 hover:bg-maroon-800 text-white py-2 rounded transition duration-300">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="inline-block text-maroon-700 hover:text-maroon-800 font-medium">
                    Lihat Semua Produk <span class="ml-1">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Kategori Produk</h2>
                <p class="text-maroon-600 mt-2">Jelajahi berbagai koleksi handmade kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Tas & Dompet</h3>
                    <p class="text-slate-600">Koleksi tas dan dompet handmade dengan berbagai desain unik</p>
                </div>

                <!-- Category 2 -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Aksesoris</h3>
                    <p class="text-slate-600">Perhiasan dan aksesoris handmade dengan sentuhan personal</p>
                </div>

                <!-- Category 3 -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Dekorasi Rumah</h3>
                    <p class="text-slate-600">Hiasan dinding, pajangan, dan dekorasi rumah dengan sentuhan artistik</p>
                </div>

                <!-- Category 4 -->
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Mainan & Boneka</h3>
                    <p class="text-slate-600">Mainan kayu dan boneka handmade yang unik untuk anak-anak</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Order Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-slate-800 rounded-lg shadow-xl overflow-hidden">
                <div class="md:flex justify-center items-center">
                    <div class="md:w-1/2">
                        <img src="https://img.freepik.com/free-photo/top-view-woman-creating-vision-board_23-2150061856.jpg?t=st=1746472383~exp=1746475983~hmac=9ea84566e1e476f133543d337165901d37829e532c742b4acec24814cd1743dd&w=1380"
                            alt="Custom Order" class="w-full h-[410px] object-cover">
                    </div>
                    <div class="md:w-1/2 p-8 md:p-12 flex items-center">
                        <div>
                            <span
                                class="inline-block px-3 py-1 bg-maroon-100 text-maroon-800 rounded-full text-sm font-semibold mb-4 text-slate-50">
                                Layanan Khusus
                            </span>
                            <h2 class="text-3xl font-bold text-white mb-4">Pesanan Kustom Sesuai Keinginan Anda</h2>
                            <p class="text-slate-300 mb-6">
                                Kami menerima pesanan custom untuk berbagai produk handmade sesuai dengan kebutuhan dan
                                keinginan Anda:
                            </p>
                            <ul class="text-slate-300 space-y-2 mb-8">
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-maroon-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Pilihan bahan berkualitas premium
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-maroon-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Personalisasi warna, ukuran, dan desain
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-maroon-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Konsultasi langsung dengan pengrajin berpengalaman
                                </li>
                            </ul>
                            <button
                                class="bg-maroon-600 hover:bg-maroon-700 text-white font-bold py-3 px-6 rounded-md transition duration-300">
                                Buat Pesanan Kustom
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Ulasan Pelanggan</h2>
                <p class="text-maroon-600 mt-2">Apa kata pelanggan tentang produk handmade kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex text-maroon-500 mb-4">★★★★★</div>
                    <p class="text-slate-600 italic mb-4">"Tas rajut yang saya pesan benar-benar cantik dan detail
                        pengerjaannya sangat rapi. Sangat puas dengan kualitasnya!"</p>
                    <div class="flex items-center">
                        <div class="bg-maroon-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                            <span class="text-maroon-700 font-bold">DP</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Dewi Pratiwi</p>
                            <p class="text-sm text-slate-500">Jakarta</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex text-maroon-500 mb-4">★★★★★</div>
                    <p class="text-slate-600 italic mb-4">"Saya memesan boneka custom untuk hadiah ulang tahun anak saya
                        dan hasilnya melebihi ekspektasi. Pengerjaan cepat dan komunikasi yang baik!"</p>
                    <div class="flex items-center">
                        <div class="bg-maroon-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                            <span class="text-maroon-700 font-bold">BS</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Budi Santoso</p>
                            <p class="text-sm text-slate-500">Surabaya</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex text-maroon-500 mb-4">★★★★★</div>
                    <p class="text-slate-600 italic mb-4">"Hiasan dinding macramé yang saya beli sangat indah dan menjadi
                        pusat perhatian di ruang tamu saya. Pengrajinnya sangat berbakat!"</p>
                    <div class="flex items-center">
                        <div class="bg-maroon-100 w-10 h-10 rounded-full flex items-center justify-center mr-3">
                            <span class="text-maroon-700 font-bold">RA</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Rina Anggraini</p>
                            <p class="text-sm text-slate-500">Bandung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Mengapa Memilih Kami</h2>
                <p class="text-maroon-600 mt-2">Keunggulan produk handmade dari Artisan Craft Co.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Kualitas Premium</h3>
                    <p class="text-slate-600">Setiap produk dibuat dengan bahan berkualitas tinggi dan dikerjakan dengan
                        teliti.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Karya Unik</h3>
                    <p class="text-slate-600">Setiap produk memiliki keunikan tersendiri karena dibuat dengan tangan oleh
                        pengrajin lokal.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="bg-maroon-100 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-maroon-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900 mb-2">Harga Terjangkau</h3>
                    <p class="text-slate-600">Kami menawarkan produk handmade berkualitas dengan harga yang bersaing.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 bg-maroon-800">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Temukan Keunikan Produk Handmade</h2>
            <p class="text-maroon-100 mb-8 max-w-2xl mx-auto">Jelajahi koleksi produk handmade eksklusif kami atau buat
                pesanan khusus sesuai keinginan Anda.</p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                <button
                    class="bg-white hover:bg-slate-100 text-maroon-800 font-bold py-3 px-8 rounded-md transition duration-300">
                    Belanja Sekarang
                </button>
                <button
                    class="bg-transparent hover:bg-maroon-700 text-white border border-white font-bold py-3 px-8 rounded-md transition duration-300">
                    Buat Pesanan Kustom
                </button>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button id="scrollToTopButton"
        class="fixed bottom-8 right-8 bg-maroon-700 text-white p-3 rounded-full shadow-lg cursor-pointer hidden hover:bg-maroon-800 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollToTopButton = document.getElementById("scrollToTopButton");

            window.addEventListener("scroll", () => {
                if (window.scrollY > 300) {
                    scrollToTopButton.classList.remove("hidden");
                } else {
                    scrollToTopButton.classList.add("hidden");
                }
            });

            scrollToTopButton.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            });
        });
    </script>
@endsection
