@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Laporan Transaksi</h1>

        {{-- Form Filter Tanggal --}}
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <form action="{{ route('admin.transaksi.laporan') }}" method="GET">
                <div class="flex flex-wrap md:flex-nowrap items-end gap-4">
                    <div class="w-full md:w-1/3">
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="w-full md:w-1/3">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-center gap-2 mt-4 md:mt-0">
                        <button type="submit"
                            class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            Filter
                        </button>
                        {{-- Tombol Export PDF --}}
                        @if (request()->has('start_date') && request()->has('end_date'))
                            <a href="{{ route('admin.transaksi.exportPdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                                class="bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300"
                                target="_blank">
                                Export PDF
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabel Hasil Laporan --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transaksis ?? [] as $transaksi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->id_transaksi_222336 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $transaksi->pelanggan->nama_pelanggan_222336 ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->produk->nama_produk_222336 ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp
                                {{ number_format($transaksi->total_harga_222336, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($transaksi->status_222336 == 'completed') bg-green-100 text-green-800
                                @elseif($transaksi->status_222336 == 'processing') bg-yellow-100 text-yellow-800
                                @elseif($transaksi->status_222336 == 'pending') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($transaksi->status_222336) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                Silakan pilih rentang tanggal untuk menampilkan laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
