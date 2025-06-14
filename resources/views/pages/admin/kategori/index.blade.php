@extends('layouts.admin')

@section('title', 'Daftar Kategori Produk')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header dengan background merah -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg shadow-lg p-6 mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Daftar Kategori Produk</h1>
                        <p class="text-red-100 mt-1">Kelola semua kategori produk dalam toko Anda</p>
                    </div>
                    <a href="{{ route('admin.kategori_produk.create') }}"
                        class="bg-white hover:bg-gray-100 text-red-600 font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>Tambah Kategori
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
                    <h2 class="text-lg font-semibold text-red-800">Data Kategori Produk</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-red-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Gambar</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama Kategori</th>
                                <th scope="col"
                                    class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kategori as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->path_img_222336)
                                            <img src="{{ Storage::url($item->path_img_222336) }}"
                                                alt="{{ $item->nama_222336 }}"
                                                class="h-20 w-20 object-cover rounded-lg shadow-md border-2 border-gray-200">
                                        @else
                                            <div
                                                class="h-20 w-20 bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                                                <i class="fas fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama_222336 }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.kategori_produk.show', $item->id_222336) }}"
                                                class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                <i class="fas fa-eye mr-1"></i>Detail
                                            </a>
                                            <a href="{{ route('admin.kategori_produk.edit', $item->id_222336) }}"
                                                class="bg-indigo-100 hover:bg-indigo-200 text-indigo-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                            <form action="{{ route('admin.kategori_produk.destroy', $item->id_222336) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                                    <td colspan="3" class="px-6 py-12 whitespace-nowrap text-center">
                                        <div class="text-gray-500">
                                            <i class="fas fa-box-open text-4xl mb-4"></i>
                                            <p class="text-lg font-medium">Belum ada data kategori produk</p>
                                            <p class="text-sm">Tambahkan kategori pertama Anda sekarang</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
