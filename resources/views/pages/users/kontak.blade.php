@extends('layouts.app')

@section('title', 'Kontak Kami - NurulMade')

@section('content')
    <section class="relative bg-gray-50">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto py-12">
            <div class="w-full justify-start items-center xl:gap-12 gap-10 grid lg:grid-cols-2 grid-cols-1">
                <div class="w-full flex-col justify-center lg:items-start items-center gap-10 inline-flex">
                    <div class="w-full flex-col justify-center items-start gap-8 flex">
                        <div class="flex-col justify-start lg:items-start items-center gap-4 flex">
                            <div class="w-full flex-col justify-start lg:items-start items-center gap-3 flex">
                                <h2
                                    class="text-4xl font-bold font-manrope leading-normal lg:text-start text-center text-red-800">
                                    Hubungi NurulMade
                                </h2>
                                <p class="text-red-600 text-base font-normal leading-relaxed lg:text-start text-center">
                                    Kami menciptakan produk buatan tangan yang unik dengan sentuhan personal. Hubungi kami
                                    untuk pesanan khusus, pertanyaan, atau sekadar untuk menyapa!
                                </p>
                            </div>
                        </div>
                        <div class="w-full flex-col justify-center items-start gap-6 flex">
                            <div class="w-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Telepon</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">+62 812 3456 7890</p>
                                </div>
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Email</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">
                                        kontak@nurulmade.com</p>
                                </div>
                            </div>
                            <div class="w-full h-full justify-start items-center gap-8 grid md:grid-cols-2 grid-cols-1">
                                <div
                                    class="w-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Workshop</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Jl. Kreatif No. 45,
                                        Jakarta, Indonesia</p>
                                </div>
                                <div
                                    class="w-full h-full p-3.5 rounded-xl border border-red-200 hover:border-red-400 transition-all duration-700 ease-in-out flex-col justify-start items-start gap-2.5 inline-flex bg-red-100">
                                    <h4 class="text-2xl font-bold font-manrope leading-9 text-red-800">Jam Kerja</h4>
                                    <p class="text-red-600 text-base font-normal leading-relaxed">Senin - Jumat, 09:00 -
                                        17:00 WIB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full p-6 bg-white rounded-xl border border-red-200 shadow-md">
                        <h3 class="text-2xl font-bold font-manrope mb-4 text-red-800">Kirim Pesan</h3>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-red-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="name"
                                        class="w-full px-4 py-2 border border-red-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-red-700 mb-1">Email</label>
                                    <input type="email" id="email"
                                        class="w-full px-4 py-2 border border-red-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                                </div>
                            </div>
                            <div>
                                <label for="subject" class="block text-red-700 mb-1">Subjek</label>
                                <input type="text" id="subject"
                                    class="w-full px-4 py-2 border border-red-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>
                            <div>
                                <label for="message" class="block text-red-700 mb-1">Pesan</label>
                                <textarea id="message" rows="4"
                                    class="w-full px-4 py-2 border border-red-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">Kirim
                                Pesan</button>
                        </form>
                    </div>
                </div>

                <div class="w-full lg:justify-start justify-center items-start flex">
                    <div
                        class="sm:w-[564px] w-full sm:h-[946px] h-full sm:border border-red-200 rounded-xl overflow-hidden shadow-lg relative">
                        <img class="w-full h-full object-cover" src="{{ asset('images/kontak.jpg') }}"
                            alt="NurulMade Handmade Crafts" />
                        <div class="absolute bottom-0 left-0 right-0 bg-red-800 bg-opacity-80 text-white p-4">
                            <h3 class="text-xl font-bold mb-2">Kreasi Tangan NurulMade</h3>
                            <p class="text-sm">Setiap produk dibuat dengan cinta dan ketelitian untuk Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
