@extends('layouts.app')

@section('title', 'Voucher Saya')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Voucher Saya</h1>
                <p class="mt-2 text-lg text-gray-600">Gunakan voucher spesial ini untuk mendapatkan diskon pada pesanan Anda.
                </p>
            </div>

            @forelse ($vouchers as $voucher)
                @php
                    // Tentukan status voucher
                    $isUsed = $voucher->status_222336 === 'terpakai';
                    $isExpired = $voucher->tanggal_kadaluarsa_222336 < now();
                    $isActive = !$isUsed && !$isExpired;
                @endphp

                <div
                    class="relative max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden mb-6 transition-transform duration-300 hover:scale-105">
                    {{-- Bagian utama voucher --}}
                    <div class="flex">
                        {{-- Bagian Kiri (Logo & Diskon) --}}
                        <div
                            class="flex-shrink-0 w-1/3 bg-blue-600 p-6 flex flex-col items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2H5z" />
                            </svg>
                            <span
                                class="text-3xl font-extrabold mt-2">{{ rtrim(rtrim(number_format($voucher->persentase_diskon_222336, 2), '0'), '.') }}%</span>
                            <span class="font-semibold">DISKON</span>
                        </div>

                        {{-- Bagian Kanan (Detail Voucher) --}}
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start">
                                <p class="text-sm font-semibold uppercase text-blue-600">{{ $voucher->tipe_222336 }}</p>

                                @if ($isActive)
                                    <span
                                        class="px-2 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">Aktif</span>
                                @elseif ($isUsed)
                                    <span
                                        class="px-2 py-1 text-xs font-bold text-gray-800 bg-gray-200 rounded-full">Terpakai</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">Kadaluarsa</span>
                                @endif
                            </div>

                            <p class="text-gray-600 mt-2">Dapatkan potongan harga sebesar
                                {{ rtrim(rtrim(number_format($voucher->persentase_diskon_222336, 2), '0'), '.') }}% untuk
                                transaksimu berikutnya.</p>

                            <div class="mt-4 pt-4 border-t border-dashed">
                                <p class="text-sm text-gray-500">Berlaku hingga:
                                    {{ \Carbon\Carbon::parse($voucher->tanggal_kadaluarsa_222336)->format('d F Y') }}</p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span id="code-{{ $voucher->id_voucher_222336 }}"
                                        class="text-lg font-mono bg-gray-100 p-2 rounded border border-dashed">{{ $voucher->kode_voucher_222336 }}</span>
                                    <button
                                        onclick="copyCode('{{ $voucher->id_voucher_222336 }}', '{{ $voucher->kode_voucher_222336 }}')"
                                        class="copy-btn bg-gray-800 text-white px-3 py-2 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 disabled:bg-gray-400"
                                        {{ !$isActive ? 'disabled' : '' }}>
                                        Salin
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Overlay untuk voucher yang tidak aktif --}}
                    @if (!$isActive)
                        <div
                            class="absolute inset-0 bg-white bg-opacity-70 backdrop-blur-sm flex items-center justify-center">
                            <span
                                class="text-gray-500 text-2xl font-bold transform -rotate-12 border-4 border-gray-500 p-2 rounded">
                                {{ $isUsed ? 'SUDAH DIPAKAI' : 'KADALUARSA' }}
                            </span>
                        </div>
                    @endif
                </div>
            @empty
                {{-- Tampilan jika tidak ada voucher --}}
                <div class="text-center max-w-lg mx-auto bg-white p-10 rounded-lg shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-medium text-gray-900">Anda Belum Punya Voucher</h3>
                    <p class="mt-2 text-gray-500">Saat ini Anda belum memiliki voucher. Terus bertransaksi untuk mendapatkan
                        voucher menarik dari kami!</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                            Mulai Belanja
                        </a>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyCode(voucherId, codeToCopy) {
            // Gunakan API modern untuk menyalin ke clipboard
            navigator.clipboard.writeText(codeToCopy).then(() => {
                const button = document.querySelector(`button[onclick*="${voucherId}"]`);
                if (button) {
                    // Beri feedback visual ke pengguna
                    const originalText = button.innerHTML;
                    button.innerHTML = 'Tersalin!';
                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                    button.classList.remove('bg-gray-800', 'hover:bg-gray-900');

                    // Kembalikan ke keadaan semula setelah beberapa detik
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('bg-green-600', 'hover:bg-green-700');
                        button.classList.add('bg-gray-800', 'hover:bg-gray-900');
                    }, 2000); // 2 detik
                }
            }).catch(err => {
                console.error('Gagal menyalin kode: ', err);
                alert('Oops, gagal menyalin kode. Silakan coba salin manual.');
            });
        }
    </script>
@endpush
