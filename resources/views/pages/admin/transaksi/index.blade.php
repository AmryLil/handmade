@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
    <div class="rounded-xl w-full">
        <div
            class="flex justify-between items-center mb-4 p-4 text-red-800 rounded-t-xl bg-white shadow-md border-l-4 border-red-600">
            <h1 class="text-2xl font-bold">Kelola Data Transaksi</h1>
            <a href="{{ route('admin.laporan') }}"
                class="bg-red-600 text-white hover:bg-red-700 font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out">
                Lihat Laporan
            </a>
        </div>

        <div class="overflow-x-auto px-4 bg-white rounded-b-xl shadow-md pb-6">
            <table class="table-auto w-full border-collapse rounded-xl overflow-hidden shadow-sm mt-4">
                <thead class="bg-red-600 text-white text-lg">
                    <tr>
                        <th class="py-4 px-6 text-left">ID</th>
                        <th class="py-4 px-6 text-left">Pelanggan</th>
                        <th class="py-4 px-6 text-left">Tanggal</th>
                        <th class="py-4 px-6 text-left">Total</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($transaksis as $transaksi)
                        <tr class="odd:bg-white even:bg-red-50 hover:bg-red-100 transition duration-200">
                            <td class="py-4 px-6 font-semibold">#{{ $transaksi->id_transaksi_222336 }}</td>
                            <td class="py-4 px-6">{{ $transaksi->pelanggan->name ?? 'N/A' }}</td>
                            <td class="py-4 px-6">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi_222336)->format('d M Y') }}</td>
                            <td class="py-4 px-6">Rp {{ number_format($transaksi->harga_total_222336, 0, ',', '.') }}</td>

                            <td class="py-4 px-6 text-center">
                                <select id="status-{{ $transaksi->id_transaksi_222336 }}"
                                    onchange="updateTransactionStatus('{{ $transaksi->id_transaksi_222336 }}', this.value)"
                                    class="px-3 py-1 text-sm font-semibold rounded-full border-none focus:ring-2 focus:ring-red-500
                            @if ($transaksi->status_222336 == 'selesai') bg-green-100 text-green-800
                            @elseif($transaksi->status_222336 == 'dikirim') bg-purple-100 text-purple-800
                            @elseif($transaksi->status_222336 == 'dikemas') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800 @endif">
                                    <option value="pending" {{ $transaksi->status_222336 == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="dikemas" {{ $transaksi->status_222336 == 'dikemas' ? 'selected' : '' }}>
                                        Dikemas</option>
                                    <option value="dikirim" {{ $transaksi->status_222336 == 'dikirim' ? 'selected' : '' }}>
                                        Dikirim</option>
                                    <option value="selesai" {{ $transaksi->status_222336 == 'selesai' ? 'selected' : '' }}>
                                        Selesai</option>
                                </select>
                            </td>

                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('admin.transaksi.show', $transaksi->id_transaksi_222336) }}"
                                    class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition inline-block"
                                    title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 px-6 text-center text-gray-500">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div id="toast" class="fixed top-5 right-5 z-50 hidden">
        <div id="toast-content" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <span id="toast-message"></span>
        </div>
    </div>
    <script>
        function updateTransactionStatus(transactionId, newStatus) {
            const selectElement = document.getElementById(`status-${transactionId}`);
            const originalValue = selectElement.dataset.originalValue || selectElement.value;
            selectElement.dataset.originalValue = originalValue; // Simpan nilai asli

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
                        // Jika respons tidak OK, lempar error untuk ditangkap di .catch
                        return response.json().then(err => {
                            throw new Error(err.message || 'Gagal memperbarui status.')
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        // Update warna background dropdown
                        updateSelectColor(selectElement, newStatus);
                        // Set nilai asli yang baru
                        selectElement.dataset.originalValue = newStatus;
                    } else {
                        // Jika gagal, kembalikan ke nilai semula
                        selectElement.value = originalValue;
                        showToast(data.message || 'Gagal memperbarui status.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Jika ada error, kembalikan ke nilai semula
                    selectElement.value = originalValue;
                    showToast(error.message, 'error');
                });
        }

        function updateSelectColor(selectElement, status) {
            // Hapus kelas warna lama
            selectElement.classList.remove('bg-green-100', 'text-green-800', 'bg-yellow-100', 'text-yellow-800',
                'bg-blue-100', 'text-blue-800', 'bg-gray-100', 'text-gray-800');

            // Tambah kelas warna baru
            if (status === 'completed') {
                selectElement.classList.add('bg-green-100', 'text-green-800');
            } else if (status === 'processing') {
                selectElement.classList.add('bg-yellow-100', 'text-yellow-800');
            } else if (status === 'pending') {
                selectElement.classList.add('bg-blue-100', 'text-blue-800');
            } else {
                selectElement.classList.add('bg-gray-100', 'text-gray-800');
            }
        }

        // Fungsi untuk menampilkan notifikasi toast
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastContent = document.getElementById('toast-content');
            const toastMessage = document.getElementById('toast-message');

            toastMessage.textContent = message;

            // Update warna toast berdasarkan tipe
            toastContent.className = 'text-white px-6 py-3 rounded-lg shadow-lg'; // Reset class
            if (type === 'error') {
                toastContent.classList.add('bg-red-500');
            } else {
                toastContent.classList.add('bg-green-500');
            }

            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
    </script>
@endsection
