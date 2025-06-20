@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    {{-- ... [bagian sebelumnya tetap sama] ... --}}

    <!-- Modal Pembayaran -->
    <div id="payment-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-auto">
            <div class="p-6">
                <div class="flex justify-between items-center border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-900">Pembayaran</h3>
                    <button onclick="closePaymentModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                    <!-- Daftar Produk -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Produk Dibeli</h4>
                        <div class="space-y-4" id="payment-products-list">
                            <!-- Produk akan diisi oleh JavaScript -->
                        </div>

                        <div class="mt-6 pt-4 border-t">
                            <div class="flex justify-between">
                                <span class="text-lg font-medium text-gray-900">Total Pembayaran</span>
                                <span class="text-xl font-bold text-gray-900" id="payment-total">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- QRIS & Upload Bukti -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Metode Pembayaran</h4>

                        <!-- QRIS Section -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <div class="flex items-center mb-3">
                                <img src="{{ asset('images/qris-logo.png') }}" alt="QRIS" class="h-8 mr-2">
                                <span class="font-medium">QRIS Pembayaran</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-4">
                                Scan QR code berikut untuk melakukan pembayaran melalui aplikasi e-wallet atau mobile
                                banking Anda.
                            </p>
                            <div class="flex justify-center mb-4">
                                <div id="qris-code" class="bg-white p-2 rounded shadow-sm">
                                    <!-- QR Code akan digenerate oleh JavaScript -->
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 text-center">
                                Berlaku hingga: <span id="qris-expiry"></span>
                            </p>
                        </div>

                        <!-- Upload Bukti Transfer -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Upload Bukti Transfer</h4>
                            <form id="upload-batch-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="transaksi_ids" id="transaksi-ids">

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="bukti_tf">
                                        Pilih File Bukti Transfer
                                    </label>
                                    <div class="flex items-center">
                                        <input type="file" name="bukti_tf" id="bukti_tf"
                                            class="border border-gray-300 rounded-l w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            accept="image/*" required>
                                        <button type="button" onclick="document.getElementById('bukti_tf').click()"
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-r border border-l-0 border-gray-300">
                                            Pilih
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG (Maks. 2MB)</p>
                                </div>

                                <!-- Preview Image -->
                                <div id="image-preview" class="mt-4 hidden">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Pratinjau Gambar:</p>
                                    <img id="preview-image" class="max-w-full h-48 object-contain border rounded">
                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition duration-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        Konfirmasi Pembayaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ... [bagian lainnya tetap sama] ... --}}

    @push('scripts')
        <!-- QR Code Generator Library -->
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ... [kode sebelumnya tetap sama] ...

                // Preview image upload
                document.getElementById('bukti_tf').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('preview-image').src = e.target.result;
                            document.getElementById('image-preview').classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });

                // Handle form submission
                document.getElementById('upload-batch-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    uploadPaymentProof();
                });
            });

            function proceedToCheckout() {
                showLoading();

                fetch('{{ route('checkout') }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            showPaymentModal(data.products, data.total, data.transaksi_ids);
                        } else {
                            showError(data.error || 'Terjadi kesalahan saat checkout');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        console.error('Error:', error);
                        showError(error.error || 'Gagal memproses checkout');
                    });
            }

            function showPaymentModal(products, total, transaksiIds) {
                // Set transaction IDs
                document.getElementById('transaksi-ids').value = JSON.stringify(transaksiIds);

                // Set total
                document.getElementById('payment-total').textContent =
                    'Rp ' + total.toLocaleString('id-ID');

                // Render products
                const productsContainer = document.getElementById('payment-products-list');
                productsContainer.innerHTML = '';

                products.forEach(product => {
                    const productHtml = `
                            <div class="flex items-center border-b pb-4">
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                    <img src="${product.gambar}" alt="${product.nama}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <h5 class="font-medium text-gray-900">${product.nama}</h5>
                                    <div class="flex justify-between mt-1 text-sm">
                                        <span>${product.jumlah} x Rp ${product.harga.toLocaleString('id-ID')}</span>
                                        <span class="font-medium">Rp ${product.subtotal.toLocaleString('id-ID')}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    productsContainer.innerHTML += productHtml;
                });

                // Generate QR Code
                const qrisContainer = document.getElementById('qris-code');
                qrisContainer.innerHTML = '';

                // Generate random payment code
                const paymentCode = 'PAY-' + Math.random().toString(36).substr(2, 8).toUpperCase();

                new QRCode(qrisContainer, {
                    text: `https://yourpaymentgateway.com/qris?code=${paymentCode}&amount=${total}`,
                    width: 180,
                    height: 180,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                // Set expiry time (1 hour from now)
                const now = new Date();
                now.setHours(now.getHours() + 1);
                document.getElementById('qris-expiry').textContent =
                    now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    }) + ', ' +
                    now.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long'
                    });

                // Show modal
                document.getElementById('payment-modal').classList.remove('hidden');
            }

            function closePaymentModal() {
                document.getElementById('payment-modal').classList.add('hidden');
                window.location.href = '{{ route('transaksi.index') }}';
            }

            function uploadPaymentProof() {
                showLoading();

                const formData = new FormData(document.getElementById('upload-batch-form'));

                fetch('{{ route('transaksi.uploadBatch') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            showSuccess('Bukti pembayaran berhasil diupload!');
                            setTimeout(() => {
                                window.location.href = '{{ route('transaksi.index') }}';
                            }, 2000);
                        } else {
                            showError('Gagal mengupload bukti pembayaran');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        console.error('Error:', error);
                        showError('Terjadi kesalahan saat mengupload bukti');
                    });
            }
        </script>
    @endpush
@endsection
