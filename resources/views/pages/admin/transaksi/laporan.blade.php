@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">📊 Laporan Transaksi</h1>
                    <p class="text-red-100 text-lg">Kelola dan pantau semua transaksi dengan mudah</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-white text-center">
                        <div class="text-2xl font-bold">{{ $transaksis->count() }}</div>
                        <div class="text-sm text-red-100">Total Transaksi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
            <div class="flex items-center mb-4">
                <div class="w-1 h-6 bg-red-600 rounded-full mr-3"></div>
                <h2 class="text-xl font-semibold text-gray-800">Filter Laporan</h2>
            </div>

            <form action="{{ route('admin.laporan') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:ring-0 transition-colors">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-red-500 focus:ring-0 transition-colors">
                    </div>
                    <div class="flex gap-3">
                        <button type="submit"
                            class="bg-red-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-red-700 shadow-md flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filter
                        </button>
                    </div>
                    <div>
                        {{-- Tombol Export PDF (Kondisi @if sudah dihapus) --}}
                        <a href="{{ route('admin.transaksi.exportPdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 shadow-md flex items-center gap-2"
                            target="_blank">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">Data Transaksi</h3>
                    @if (request('start_date') && request('end_date'))
                        <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                            {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                        </span>
                    @else
                        <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                            Semua Data
                        </span>
                    @endif
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-red-50 border-b-2 border-red-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    ID Transaksi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Pelanggan
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Produk
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Total Harga
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Status
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($transaksis as $index => $transaksi)
                            <tr class="hover:bg-gray-50 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-25' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">#{{ $transaksi->id_transaksi_222336 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-red-600 font-semibold text-sm">
                                                {{ strtoupper(substr($transaksi->pelanggan->name ?? 'N', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="font-medium text-gray-900">
                                            {{ $transaksi->pelanggan->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">
                                        {{ $transaksi->produk->nama_222336 ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('d M Y') }}
                                    </div>
                                    <div class="text-gray-500 text-sm">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900 text-lg">
                                        Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($transaksi->status_222336 == 'completed') bg-green-100 text-green-800 border border-green-200
                                        @elseif($transaksi->status_222336 == 'processing') 
                                            bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($transaksi->status_222336 == 'pending') 
                                            bg-blue-100 text-blue-800 border border-blue-200
                                        @else 
                                            bg-red-100 text-red-800 border border-red-200 @endif">
                                        {{ ucfirst($transaksi->status_222336) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data transaksi</h3>
                                        <p class="text-gray-500">Data transaksi tidak ditemukan untuk periode yang dipilih.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary Footer -->
            @if ($transaksis->count() > 0)
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-red-600">{{ $transaksis->count() }}</div>
                            <div class="text-sm text-gray-600">Total Transaksi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($transaksis->sum('harga_total_222336'), 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600">Total Pendapatan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">
                                {{ $transaksis->where('status_222336', 'completed')->count() }}
                            </div>
                            <div class="text-sm text-gray-600">Transaksi Selesai</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
