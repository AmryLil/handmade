@extends('layouts.app')
@section('content')
    <div class="bg-gray-50 ">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <header class="mb-8 ">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Riwayat Transaksi</h1>
                <p class="mt-1 text-md text-gray-600">Lihat semua transaksi yang pernah Anda lakukan.</p>
            </header>

            @if ($transaksis->isEmpty())
                <div class="text-center bg-white p-12 rounded-lg border border-dashed border-gray-300">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2z" />
                    </svg>
                    <h2 class="mt-4 text-lg font-medium text-gray-900">Belum ada transaksi</h2>
                    <p class="mt-1 text-sm text-gray-500">Sepertinya Anda belum pernah berbelanja. Ayo cari produk
                        favoritmu!</p>
                    <div class="mt-6">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mulai Belanja
                        </a>
                    </div>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($transaksis as $transaksi)
                        @php
                            // Mengambil data produk, pastikan model dan relasi sudah benar
                            $produk = \App\Models\Produk::find($transaksi->id_produk_222336);
                        @endphp
                        <div
                            class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-48 md:flex-shrink-0">
                                    @if ($produk && $produk->path_img_222336)
                                        <img class="h-48 w-full object-cover md:h-full"
                                            src="{{ asset('storage/' . $produk->path_img_222336) }}"
                                            alt="Gambar {{ $produk->path_img_222336 }}">
                                    @else
                                        <div class="h-48 w-full md:h-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500 text-sm">Gambar tidak tersedia</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-5 flex-grow">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">
                                                {{ $produk ? $produk->nama_222336 : 'Produk tidak ditemukan' }}
                                            </h3>
                                            <p class="text-xs text-gray-500 mt-1">
                                                ID: {{ $transaksi->id_transaksi_222336 }}
                                            </p>
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            @php
                                                $statusClass = '';
                                                switch ($transaksi->status_222336) {
                                                    case 'selesai':
                                                        $statusClass = 'bg-green-100 text-green-800';
                                                        break;
                                                    case 'menunggu_pembayaran':
                                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                                        break;
                                                    case 'dibatalkan':
                                                        $statusClass = 'bg-red-100 text-red-800';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-gray-100 text-gray-800';
                                                }
                                            @endphp
                                            <span
                                                class="px-3 py-1 text-xs font-semibold rounded-full capitalize {{ $statusClass }}">
                                                {{ str_replace('_', ' ', $transaksi->status_222336) }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Tanggal:
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->isoFormat('dddd, D MMMM YYYY, HH:mm') }}
                                    </p>

                                    <div class="border-t border-gray-200 my-4"></div>

                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                                        <div class="mb-4 sm:mb-0">
                                            <p class="text-sm text-gray-500">Total Harga ({{ $transaksi->jumlah_222336 }}
                                                item)</p>
                                            <p class="text-xl font-semibold text-indigo-600">
                                                Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            @if ($transaksi->bukti_tf_222336)
                                                <a href="{{ asset('storage/' . $transaksi->bukti_tf_222336) }}"
                                                    target="_blank"
                                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                                    Lihat Bukti
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-500 italic">Belum ada bukti</span>
                                            @endif

                                            <a href="#"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                Beli Lagi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- <div class="mt-10">
            {{ $transaksis->links() }}
        </div> --}}
        </div>
    </div>
@endsection
