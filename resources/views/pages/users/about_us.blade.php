@extends('layouts.app')

@section('title', 'Tentang Kami - NurulMade')

@section('content')
    <section class="relative bg-gray-50 py-16">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <div class="w-full justify-start items-center xl:gap-12 gap-10 grid lg:grid-cols-2 grid-cols-1">
                <div class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex">
                    <div class="w-full flex-col justify-center items-start gap-8 flex">
                        <div class="flex-col justify-start lg:items-start items-center gap-4 flex">
                            <div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
                                <h2
                                    class="text-4xl font-bold font-manrope leading-normal lg:text-start text-center text-red-800">
                                    Kisah di Balik Setiap Jahitan
                                </h2>
                                <p class="text-red-600 text-base font-normal leading-relaxed lg:text-start text-center">
                                    NurulMade lahir dari kecintaan pada kerajinan tangan dan keinginan untuk menciptakan
                                    karya yang unik dan personal. Setiap produk kami dibuat dengan teliti, menggabungkan
                                    material berkualitas dengan sentuhan seni yang tulus.
                                </p>
                            </div>
                        </div>
                        <div class="w-full flex-col justify-center items-start gap-6 flex">
                            <div class="w-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">100% Buatan Tangan
                                    </h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Setiap karya adalah unik,
                                        dibuat satu per satu dengan ketelitian tinggi.</p>
                                </div>
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Kualitas Premium</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Kami hanya menggunakan
                                        bahan baku terbaik untuk hasil yang tahan lama.</p>
                                </div>
                            </div>
                            <div class="w-full h-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                <div
                                    class="w-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">5+ Tahun Berkarya
                                    </h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Berawal dari hobi, kini
                                        melayani pelanggan dengan penuh cinta.</p>
                                </div>
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Desain Personal</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Menerima pesanan khusus
                                        untuk hadiah yang lebih berkesan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:justify-start justify-center items-start flex">
                    <div
                        class="sm:w-[564px] w-full sm:h-[646px] h-full sm:border border-red-200 rounded-xl overflow-hidden shadow-lg relative">
                        <img class="w-full h-full object-cover" src="{{ asset('images/tentang.jpg') }}"
                            alt="Proses pembuatan kerajinan tangan NurulMade" />
                    </div>
                </div>
            </div>

            <div class="mt-16 grid md:grid-cols-2 grid-cols-1 gap-8">
                <div class="bg-white p-8 rounded-xl border border-red-200 shadow-md">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-red-800 mb-4">Visi Kami</h3>
                    <p class="text-red-600">
                        Menjadi brand kerajinan tangan terdepan di Indonesia yang menginspirasi kreativitas dan melestarikan
                        nilai-nilai keaslian produk buatan tangan. Kami bercita-cita membawa kehangatan karya personal ke
                        setiap rumah.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl border border-red-200 shadow-md">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-red-800 mb-4">Misi Kami</h3>
                    <p class="text-red-600">
                        Kami berkomitmen untuk:
                    </p>
                    <ul class="text-red-600 mt-2 space-y-2 list-disc pl-5">
                        <li>Menghasilkan produk buatan tangan dengan kualitas dan desain terbaik.</li>
                        <li>Memberikan pelayanan yang ramah dan personal kepada setiap pelanggan.</li>
                        <li>Mendukung pengrajin lokal dan menggunakan bahan baku yang ramah lingkungan.</li>
                        <li>Terus berinovasi untuk menciptakan produk-produk baru yang kreatif.</li>
                    </ul>
                </div>
            </div>

            <div class="mt-16">
                <h2 class="text-3xl font-bold text-red-800 text-center mb-8">Perjalanan Kami</h2>
                <div class="bg-white p-8 rounded-xl border border-red-200 shadow-md">
                    <div class="prose max-w-none text-red-600">
                        <p>
                            NurulMade dimulai pada tahun 2018 dari sebuah meja kecil di sudut kamar. Berbekal hasrat untuk
                            menjahit dan menciptakan sesuatu yang indah, Nurul, sang pendiri, mulai membuat dompet dan tas
                            kain untuk teman dan keluarga.
                        </p>
                        <p class="mt-4">
                            Respon positif yang diterima mendorongnya untuk membuka toko online pertama. Dari sana,
                            perjalanan kami berkembang. Kami mulai berpartisipasi dalam bazar kerajinan lokal, di mana kami
                            bisa bertemu langsung dengan para pelanggan dan mendengar cerita mereka.
                        </p>
                        <p class="mt-4">
                            Kini, NurulMade telah memiliki workshop kecil sendiri, menjadi rumah bagi tim kreatif yang
                            solid. Kami bangga telah mengirimkan ribuan produk ke seluruh penjuru Indonesia, masing-masing
                            membawa cerita dan harapan dari workshop kami.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 bg-white p-8 rounded-xl border border-red-200 shadow-md">
                <h2 class="text-3xl font-bold text-red-800 text-center mb-8">Apresiasi & Pencapaian</h2>
                <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-6 text-center">
                    <div class="p-4">
                        <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-red-800">UMKM Kreatif Award</h3>
                        <p class="text-red-500 text-sm">2023</p>
                    </div>
                    <div class="p-4">
                        <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-red-800">Pilihan Editor</h3>
                        <p class="text-red-500 text-sm">Majalah Kerajinan</p>
                    </div>
                    <div class="p-4">
                        <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-red-800">Produk Lokal Favorit</h3>
                        <p class="text-red-500 text-sm">Komunitas Crafty</p>
                    </div>
                    <div class="p-4">
                        <div class="w-16 h-16 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2-2h8a1 1 0 001-1z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.5 14H18a1 1 0 01-1-1V6a1 1 0 011-1h1.5a1 1 0 011 1v7.5a1.5 1.5 0 01-1.5 1.5z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-red-800">500+ Pengiriman</h3>
                        <p class="text-red-500 text-sm">ke Seluruh Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
