@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">🛒 Kelola Data Transaksi</h1>
                    <p class="text-red-100 text-lg">Pantau dan kelola status transaksi pelanggan</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                        <div class="text-white text-center">
                            <div class="text-2xl font-bold">{{ $transaksis->count() }}</div>
                            <div class="text-sm text-red-100">Total Transaksi</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.laporan') }}"
                        class="bg-white text-red-600 hover:bg-red-50 font-semibold px-6 py-3 rounded-lg shadow-md flex items-center gap-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white">Data Transaksi</h3>
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm">
                        Update Real-time
                    </span>
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
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Total Harga
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-red-800 uppercase tracking-wider">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($transaksis as $index => $transaksi)
                            <tr class="hover:bg-gray-50 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-25' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900 text-lg">#{{ $transaksi->id_transaksi_222336 }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-red-600 font-semibold">
                                                {{ strtoupper(substr($transaksi->pelanggan->name ?? 'N', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                {{ $transaksi->pelanggan->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $transaksi->pelanggan->id ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
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
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <select id="status-{{ $transaksi->id_transaksi_222336 }}"
                                        onchange="updateTransactionStatus('{{ $transaksi->id_transaksi_222336 }}', this.value)"
                                        class="px-4 py-2 text-sm font-semibold rounded-full border-2 focus:ring-2 focus:ring-red-500 cursor-pointer transition-all
                                        @if ($transaksi->status_222336 == 'selesai') bg-green-100 text-green-800 border-green-200
                                        @elseif($transaksi->status_222336 == 'dikirim') bg-purple-100 text-purple-800 border-purple-200
                                        @elseif($transaksi->status_222336 == 'dikemas') bg-yellow-100 text-yellow-800 border-yellow-200
                                        @else bg-blue-100 text-blue-800 border-blue-200 @endif">
                                        <option value="pending"
                                            {{ $transaksi->status_222336 == 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending</option>
                                        <option value="dikemas"
                                            {{ $transaksi->status_222336 == 'dikemas' ? 'selected' : '' }}>
                                            📦 Dikemas</option>
                                        <option value="dikirim"
                                            {{ $transaksi->status_222336 == 'dikirim' ? 'selected' : '' }}>
                                            🚚 Dikirim</option>
                                        <option value="selesai"
                                            {{ $transaksi->status_222336 == 'selesai' ? 'selected' : '' }}>
                                            ✅ Selesai</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('admin.transaksi.show', $transaksi->id_transaksi_222336) }}"
                                        class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center gap-2 shadow-md"
                                        title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="hidden md:inline">Detail</span>
                                    </a>
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
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada transaksi</h3>
                                        <p class="text-gray-500">Belum ada data transaksi yang tersedia.</p>
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
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-blue-600">
                                {{ $transaksis->where('status_222336', 'pending')->count() }}</div>
                            <div class="text-sm text-gray-600">Pending</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-yellow-600">
                                {{ $transaksis->where('status_222336', 'dikemas')->count() }}</div>
                            <div class="text-sm text-gray-600">Dikemas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-purple-600">
                                {{ $transaksis->where('status_222336', 'dikirim')->count() }}</div>
                            <div class="text-sm text-gray-600">Dikirim</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-green-600">
                                {{ $transaksi->where('status_222336', 'selesai')->count() }}</div>
                            <div class="text-sm text-gray-600">Selesai</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-5 right-5 z-50 hidden">
        <div id="toast-content" class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="toast-message"></span>
        </div>
    </div>

    <script>
        function updateTransactionStatus(transactionId, newStatus) {
            const selectElement = document.getElementById(`status-${transactionId}`);
            const originalValue = selectElement.dataset.originalValue || selectElement.value;
            selectElement.dataset.originalValue = originalValue;

            fetch(`/admin/transaksi/${transactionId}/update-status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal memperbarui status.')
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        updateSelectColor(selectElement, newStatus);
                        selectElement.dataset.originalValue = newStatus;
                    } else {
                        selectElement.value = originalValue;
                        showToast(data.message || 'Gagal memperbarui status.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    selectElement.value = originalValue;
                    showToast(error.message, 'error');
                });
        }

        function updateSelectColor(selectElement, status) {
            selectElement.classList.remove('bg-green-100', 'text-green-800', 'border-green-200',
                'bg-yellow-100', 'text-yellow-800', 'border-yellow-200',
                'bg-blue-100', 'text-blue-800', 'border-blue-200',
                'bg-purple-100', 'text-purple-800', 'border-purple-200');

            if (status === 'selesai') {
                selectElement.classList.add('bg-green-100', 'text-green-800', 'border-green-200');
            } else if (status === 'dikirim') {
                selectElement.classList.add('bg-purple-100', 'text-purple-800', 'border-purple-200');
            } else if (status === 'dikemas') {
                selectElement.classList.add('bg-yellow-100', 'text-yellow-800', 'border-yellow-200');
            } else {
                selectElement.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-200');
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastContent = document.getElementById('toast-content');
            const toastMessage = document.getElementById('toast-message');

            toastMessage.textContent = message;

            toastContent.className = 'text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3';
            if (type === 'error') {
                toastContent.classList.add('bg-red-500');
            } else {
                toastContent.classList.add('bg-green-500');
            }

            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 4000);
        }
    </script>
@endsection
