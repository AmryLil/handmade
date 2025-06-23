@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        {{-- Notifikasi Sukses atau Error dari session --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Produk ({{ $item_count }})</h2>

                    @if ($cart && $items->count() > 0)
                        @foreach ($items as $item)
                            <div class="cart-item flex items-center border-b py-4 last:border-b-0"
                                data-id="{{ $item->product->id_222336 }}" data-name="{{ $item->product->nama_222336 }}"
                                data-quantity="{{ $item->quantity_222336 }}" data-price="{{ $item->price_222336 }}"
                                data-subtotal="{{ $item->quantity_222336 * $item->price_222336 }}">

                                <img src="{{ $item->product->getImageUrlAttribute() ?? '/images/no-image.png' }}"
                                    alt="{{ $item->product->nama_222336 }}" class="w-16 h-16 object-cover rounded">

                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium">{{ $item->product->nama_222336 }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ $item->product->kategori->nama_222336 ?? 'Kategori' }}</p>
                                    <p class="text-blue-600 font-semibold">Rp
                                        {{ number_format($item->price_222336, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex items-center mx-4">
                                    <button
                                        onclick="updateQuantity('{{ $item->id_222336 }}', {{ $item->quantity_222336 - 1 }})"
                                        class="bg-gray-200 px-2 py-1 rounded-l disabled:opacity-50"
                                        {{ $item->quantity_222336 <= 1 ? 'disabled' : '' }}>-</button>
                                    <input value="{{ $item->quantity_222336 }}"
                                        class="w-16 text-center border-t border-b py-1" min="1"
                                        max="{{ $item->product->jumlah_222336 }}"
                                        onchange="updateQuantity({{ $item->id_222336 }}, this.value)">
                                    <button
                                        onclick="updateQuantity('{{ $item->id_222336 }}', {{ $item->quantity_222336 + 1 }})"
                                        class="bg-gray-200 px-2 py-1 rounded-r disabled:opacity-50"
                                        {{ $item->quantity_222336 >= $item->product->jumlah_222336 ? 'disabled' : '' }}>+</button>
                                </div>

                                <div class="text-right">
                                    <p class="font-semibold">Rp
                                        {{ number_format($item->quantity_222336 * $item->price_222336, 0, ',', '.') }}</p>
                                    <button onclick="removeItem('{{ $item->id_222336 }}')"
                                        class="text-red-600 text-sm hover:underline">Hapus</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Keranjang kosong</p>
                            <a href="{{ route('products.index') }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mulai Belanja</a>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">← Lanjut Belanja</a>
                </div>
            </div>

            {{-- ============== START PERUBAHAN DISINI ============== --}}
            <div class="bg-white rounded-lg shadow p-6 h-fit">
                <h2 class="text-lg font-semibold mb-4">Ringkasan</h2>

                {{-- Input Voucher --}}
                <div class="mb-4">
                    <label for="kode-voucher-input" class="block text-sm font-medium text-gray-700 mb-1">Punya
                        Voucher?</label>
                    <div class="flex">
                        <input type="text" id="kode-voucher-input" placeholder="Masukkan kode voucher"
                            class="flex-1 border rounded-l p-2 focus:ring-blue-500 focus:border-blue-500">
                        <button id="apply-voucher-btn"
                            class="bg-gray-800 text-white px-4 rounded-r hover:bg-gray-900">Pakai</button>
                    </div>
                    <p id="voucher-status-message" class="text-sm mt-2"></p>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        {{-- Simpan nilai asli subtotal di data attribute untuk kalkulasi JS --}}
                        <span id="summary-subtotal" data-value="{{ $total }}">Rp
                            {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-green-600" id="summary-discount-container" style="display: none;">
                        <span>Diskon Voucher</span>
                        <span id="summary-discount">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span>Gratis</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span id="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if ($cart && $items->count() > 0)
                    <button onclick="showPaymentModal()"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 mb-2">Checkout</button>
                    <button onclick="clearCart()"
                        class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">Kosongkan Keranjang</button>
                @else
                    <button disabled class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed">Keranjang
                        Kosong</button>
                @endif
            </div>
            {{-- ============== AKHIR PERUBAHAN DISINI ============== --}}
        </div>
    </div>

    {{-- Payment Modal --}}
    <div id="payment-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-auto">
            <form id="payment-form" enctype="multipart/form-data">
                @csrf
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">Pembayaran</h3>
                        <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700">✕</button>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold mb-3">Produk yang dibeli:</h4>
                            <div id="checkout-products" class="space-y-2 mb-4 max-h-60 overflow-y-auto"></div>
                            <div class="border-t pt-2">
                                <div class="flex justify-between font-bold">
                                    <span>Total Akhir:</span>
                                    <span id="checkout-total">Rp 0</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-3">Scan QRIS & Upload Bukti Transfer:</h4>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">QRIS Pembayaran</label>
                                <div class="border rounded p-2 flex justify-center">
                                    <img src="{{ asset('images/qris.png') }}" alt="QRIS"
                                        class="max-h-52 object-contain">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="bukti_tf" class="block text-sm font-medium text-gray-700 mb-1">File Bukti
                                    Transfer</label>
                                <input type="file" id="bukti_tf" name="bukti_tf" accept="image/*" required
                                    class="w-full border rounded p-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG (Max 2MB)</p>
                            </div>
                            <button type="submit"
                                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Konfirmasi
                                Pembayaran</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loading" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg flex items-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <p class="ml-3">Memproses...</p>
        </div>
    </div>

    <script>
        // Pastikan CSRF Token tersedia
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ============== START SCRIPT VOUCHER ==============
        document.addEventListener('DOMContentLoaded', function() {
            // State untuk menyimpan data voucher yang sedang dipakai
            let appliedVoucher = {
                code: null,
                discountPercentage: 0
            };

            const voucherInput = document.getElementById('kode-voucher-input');
            const applyBtn = document.getElementById('apply-voucher-btn');
            const voucherStatusMsg = document.getElementById('voucher-status-message');

            const subtotalEl = document.getElementById('summary-subtotal');
            const discountContainerEl = document.getElementById('summary-discount-container');
            const discountEl = document.getElementById('summary-discount');
            const totalEl = document.getElementById('summary-total');

            const subtotalValue = parseFloat(subtotalEl.dataset.value);

            applyBtn.addEventListener('click', function() {
                // Jika sedang ada voucher, tombol berfungsi untuk menghapus
                if (appliedVoucher.code) {
                    resetVoucherState();
                    return;
                }

                const voucherCode = voucherInput.value.trim();
                if (!voucherCode) {
                    voucherStatusMsg.textContent = 'Harap masukkan kode voucher.';
                    voucherStatusMsg.className = 'text-sm mt-2 text-red-600';
                    return;
                }

                checkVoucherOnServer(voucherCode);
            });

            function checkVoucherOnServer(code) {
                showLoading();
                // Menggunakan URL yang sama seperti yang kita buat di LoginController
                fetch('{{ route('vouchers.validate') }}', { // Pastikan route ini ada
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            kode_voucher: code
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.valid) {
                            applyVoucher(code, data.persentase_diskon);
                            voucherStatusMsg.textContent = data.message;
                            voucherStatusMsg.className = 'text-sm mt-2 text-green-600';
                        } else {
                            resetVoucherState();
                            voucherStatusMsg.textContent = data.message;
                            voucherStatusMsg.className = 'text-sm mt-2 text-red-600';
                        }
                    })
                    .catch(err => {
                        hideLoading();
                        console.error("Voucher check error:", err);
                        voucherStatusMsg.textContent = 'Terjadi kesalahan saat memeriksa voucher.';
                        voucherStatusMsg.className = 'text-sm mt-2 text-red-600';
                    });
            }

            function applyVoucher(code, percentage) {
                appliedVoucher.code = code;
                appliedVoucher.discountPercentage = parseFloat(percentage);

                updateSummary();

                // Ubah tampilan tombol
                applyBtn.textContent = 'Hapus';
                applyBtn.classList.remove('bg-gray-800', 'hover:bg-gray-900');
                applyBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                voucherInput.disabled = true;
            }

            function resetVoucherState() {
                appliedVoucher.code = null;
                appliedVoucher.discountPercentage = 0;

                updateSummary();

                // Kembalikan tampilan tombol
                applyBtn.textContent = 'Pakai';
                applyBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
                applyBtn.classList.add('bg-gray-800', 'hover:bg-gray-900');
                voucherInput.disabled = false;
                voucherInput.value = '';
                voucherStatusMsg.textContent = '';
            }

            function updateSummary() {
                let discountAmount = 0;
                if (appliedVoucher.code) {
                    discountAmount = (subtotalValue * appliedVoucher.discountPercentage) / 100;
                    discountEl.textContent = `- Rp ${numberFormat(discountAmount)}`;
                    discountContainerEl.style.display = 'flex';
                } else {
                    discountContainerEl.style.display = 'none';
                }

                const finalTotal = subtotalValue - discountAmount;
                totalEl.textContent = `Rp ${numberFormat(finalTotal)}`;
            }
        });


        function showPaymentModal() {
            const productsList = document.getElementById('checkout-products');
            const totalElement = document.getElementById('checkout-total');
            const modal = document.getElementById('payment-modal');
            productsList.innerHTML = '';
            let cartItems = [];

            document.querySelectorAll('.cart-item').forEach(item => {
                const productData = {
                    id: item.dataset.id,
                    nama: item.dataset.name,
                    jumlah: parseInt(item.dataset.quantity),
                    subtotal: parseFloat(item.dataset.subtotal)
                };
                cartItems.push(productData);
                productsList.innerHTML +=
                    `<div class="flex justify-between text-sm"><span class="truncate pr-2">${productData.nama} (${productData.jumlah}x)</span><span>Rp ${numberFormat(productData.subtotal)}</span></div>`;
            });

            const form = document.getElementById('payment-form');
            // Hapus input lama jika ada untuk mencegah duplikasi
            if (form.querySelector('input[name="cart_items"]')) {
                form.querySelector('input[name="cart_items"]').remove();
            }
            if (form.querySelector('input[name="kode_voucher"]')) {
                form.querySelector('input[name="kode_voucher"]').remove();
            }

            // Tambahkan input hidden untuk data keranjang
            const cartInput = document.createElement('input');
            cartInput.type = 'hidden';
            cartInput.name = 'cart_items';
            cartInput.value = JSON.stringify(cartItems);
            form.appendChild(cartInput);

            // ============== PERUBAHAN DISINI ==============
            // Tambahkan input hidden untuk kode voucher yang dipakai
            const voucherInput = document.createElement('input');
            voucherInput.type = 'hidden';
            voucherInput.name = 'kode_voucher';
            voucherInput.value = document.getElementById('kode-voucher-input')
                .value; // Ambil nilai voucher yang sedang diterapkan
            form.appendChild(voucherInput);

            // Ambil total akhir dari ringkasan yang sudah dihitung dengan diskon
            totalElement.textContent = document.getElementById('summary-total').textContent;
            // ===============================================

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            document.getElementById('payment-modal').classList.add('hidden');
            document.getElementById('payment-modal').classList.remove('flex');

        }

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();
            const formData = new FormData(this);

            fetch('{{ route('checkout.complete') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
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
                    if (data.redirect_url) {
                        alert('Checkout berhasil! Anda akan diarahkan ke halaman transaksi.');
                        window.location.href = data.redirect_url;
                    }
                })
                .catch(error => {
                    hideLoading();
                    console.error('Checkout Error:', error);
                    let errorMessage = 'Gagal memproses pembayaran.';
                    if (error.error) {
                        errorMessage += `\n\nPesan: ${error.error}`;
                    } else if (error.errors) {
                        const firstError = Object.values(error.errors)[0][0];
                        errorMessage += `\n\nPesan: ${firstError}`;
                    }
                    alert(errorMessage);
                });
        });

        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
            document.getElementById('loading').classList.add('flex');
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('loading').classList.remove('flex');
        }

        function numberFormat(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // --- Fungsi bawaan yang sudah ada, tidak perlu diubah ---
        function updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) return;
            showLoading();
            fetch(`/cart/item/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: parseInt(newQuantity)
                })
            }).then(res => res.json()).then(data => {
                if (data.message) {
                    location.reload();
                } else {
                    hideLoading();
                    alert(data.error || 'Gagal memperbarui kuantitas produk.');
                }
            }).catch(err => {
                hideLoading();
                alert('Terjadi kesalahan: ' + err);
            });
        }

        function removeItem(itemId) {
            if (!confirm('Anda yakin ingin menghapus item ini dari keranjang?')) return;
            showLoading();
            fetch(`/cart/item/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                if (data.message) {
                    location.reload();
                } else {
                    hideLoading();
                    alert(data.error || 'Gagal menghapus item.');
                }
            }).catch(err => {
                hideLoading();
                alert('Terjadi kesalahan: ' + err);
            });
        }

        function clearCart() {
            if (!confirm('Anda yakin ingin mengosongkan seluruh keranjang belanja?')) return;
            showLoading();
            fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                if (data.message) {
                    location.reload();
                } else {
                    hideLoading();
                    alert(data.error || 'Gagal mengosongkan keranjang.');
                }
            }).catch(err => {
                hideLoading();
                alert('Terjadi kesalahan: ' + err);
            });
        }
    </script>
@endsection
