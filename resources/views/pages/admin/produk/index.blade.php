@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header dengan background merah -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg shadow-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Daftar Produk</h1>
                        <p class="text-red-100 mt-1">Kelola semua produk dalam toko Anda</p>
                    </div>
                    <a href="{{ route('admin.produk.create') }}"
                        class="bg-white hover:bg-gray-100 text-red-600 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Tambah Produk
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
                <!-- Header tabel dengan warna merah -->
                <div class="bg-red-50 border-b border-red-200 px-6 py-4">
                    <h2 class="text-lg font-semibold text-red-800">Data Produk</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-red-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Gambar</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Kategori</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Harga</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Stok</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($produk as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $item->id_222336 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            @if ($item->path_img_222336)
                                                <img class="h-20 w-20 object-cover rounded-lg shadow-md border-2 border-gray-200"
                                                    src="{{ $item->getImageUrlAttribute() }}"
                                                    alt="{{ $item->nama_222336 }}">
                                            @else
                                                <div
                                                    class="h-20 w-20 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama_222336 }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                            {{ $item->kategori->nama_222336 ?? 'Tidak Ada Kategori' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        Rp{{ number_format($item->harga_222336, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ $item->jumlah_222336 }}</span>
                                            <button
                                                onclick="openStockModal('{{ $item->id_222336 }}', '{{ e($item->nama_222336) }}', {{ $item->jumlah_222336 }})"
                                                class="bg-red-100 hover:bg-red-200 text-red-600 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-150">
                                                <i class="fas fa-edit mr-1"></i>Update
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.produk.show', $item) }}"
                                                class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </a>
                                            <a href="{{ route('admin.produk.edit', $item) }}"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                            <form action="{{ route('admin.produk.destroy', $item) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                    <i class="fas fa-trash mr-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 whitespace-nowrap text-center">
                                        <div class="text-gray-500">
                                            <i class="fas fa-box-open text-4xl mb-4"></i>
                                            <p class="text-lg font-medium">Belum ada data produk</p>
                                            <p class="text-sm">Tambahkan produk pertama Anda sekarang</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination dengan style yang diperbaiki -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Stok -->
    <div id="stockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Ubah Stok Produk</h3>
                    <button onclick="closeStockModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="stockForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mt-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                            <p id="productName" class="text-sm text-gray-900 bg-gray-50 p-2 rounded-md"></p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Stok Saat Ini</label>
                            <p id="currentStockText" class="text-lg font-bold text-gray-900"></p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Aksi</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="operation_type" value="add"
                                        class="text-red-600 focus:ring-red-500" checked>
                                    <span class="ml-2 text-sm text-gray-700">Tambah/Kurangi Stok</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="operation_type" value="set"
                                        class="text-red-600 focus:ring-red-500">
                                    <span class="ml-2 text-sm text-gray-700">Atur Stok Baru</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah
                                <span class="text-xs text-gray-500">(Gunakan '-' untuk mengurangi, misal: -5)</span>
                            </label>
                            <input type="number" id="amount" name="amount" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
                                placeholder="Contoh: 10 atau -5">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-3 border-t border-gray-200">
                        <button type="button" onclick="closeStockModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors duration-150">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-150">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openStockModal(productId, productName, currentStock) {
            document.getElementById('productName').textContent = productName;
            document.getElementById('currentStockText').textContent = currentStock; // Tampilkan stok di elemen <p>
            document.getElementById('stockForm').action = `/admin/produk/${productId}/ubah-stok`; // URL baru
            document.getElementById('stockModal').classList.remove('hidden');
            document.getElementById('amount').focus(); // Fokus ke input baru
        }

        function closeStockModal() {
            document.getElementById('stockModal').classList.add('hidden');
            document.getElementById('stockForm').reset();
        }

        // Close modal when clicking outside
        document.getElementById('stockModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStockModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeStockModal();
            }
        });
    </script>
@endsection
