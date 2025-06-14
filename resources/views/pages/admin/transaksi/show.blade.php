@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="rounded-xl w-full">
        <div
            class="flex justify-between items-center mb-6 p-4 text-red-800 rounded-t-xl bg-white shadow-md border-l-4 border-red-600">
            <h1 class="text-2xl font-bold">Detail Transaksi #{{ $transaksi->id_transaksi_222336 }}</h1>
            <a href="{{ route('admin.transaksi.index') }}"
                class="bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kembali
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-6 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Transaksi</h3>
                    <p class="text-gray-600"><strong>ID Transaksi:</strong> #{{ $transaksi->id_transaksi_222336 }}</p>
                    <p class="text-gray-600"><strong>Tanggal:</strong>
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('l, d F Y H:i') }}</p>
                    <p class="text-gray-600"><strong>Total Harga:</strong> <span class="font-bold text-red-600">Rp
                            {{ number_format($transaksi->total_harga_222336, 0, ',', '.') }}</span></p>
                </div>
                <div class="flex items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Status</h3>
                        <span
                            class="px-4 py-2 inline-flex text-base leading-5 font-bold rounded-full 
                        @if ($transaksi->status_222336 == 'completed') bg-green-100 text-green-800
                        @elseif($transaksi->status_222336 == 'processing') bg-yellow-100 text-yellow-800
                        @elseif($transaksi->status_222336 == 'pending') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($transaksi->status_222336) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Pelanggan</h3>
                    @if ($transaksi->pelanggan)
                        <p class="text-gray-600"><strong>Nama:</strong> {{ $transaksi->pelanggan->nama_pelanggan_222336 }}
                        </p>
                        <p class="text-gray-600"><strong>Email:</strong> {{ $transaksi->pelanggan->email_222336 }}</p>
                        <p class="text-gray-600"><strong>Telepon:</strong>
                            {{ $transaksi->pelanggan->telepon_222336 ?? 'Tidak ada' }}</p>
                    @else
                        <p class="text-gray-500">Data pelanggan tidak ditemukan.</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Produk</h3>
                    @if ($transaksi->produk)
                        <p class="text-gray-600"><strong>Nama Produk:</strong> {{ $transaksi->produk->nama_produk_222336 }}
                        </p>
                        <p class="text-gray-600"><strong>Harga Satuan:</strong> Rp
                            {{ number_format($transaksi->produk->harga_222336, 0, ',', '.') }}</p>
                        <p class="text-gray-600"><strong>Jumlah:</strong> {{ $transaksi->jumlah_222336 }}</p>
                    @else
                        <p class="text-gray-500">Data produk tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
