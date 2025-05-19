@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Detail Produk</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.produk.edit', $produk) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                        Edit
                    </a>
                    <a href="{{ route('admin.produk.index') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 bg-red-50 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Produk</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail lengkap produk.</p>
                </div>

                <div class="border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                        <div class="md:col-span-1">
                            @if ($produk->path_img_222336)
                                <img src="{{ $produk->getImageUrlAttribute() }}" alt="{{ $produk->nama_222336 }}"
                                    class="w-full h-auto object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full aspect-square bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">ID Produk</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $produk->id_222336 }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Nama Produk</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $produk->nama_222336 }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $produk->kategori->nama_222336 ?? 'Tidak Ada Kategori' }}
                                        </span>
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Harga</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        Rp{{ number_format($produk->harga_222336, 0, ',', '.') }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Stok</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $produk->jumlah_222336 }}</dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Terakhir Diperbarui</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $produk->updated_at->format('d M Y H:i') }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">
                                        {{ $produk->deskripsi_222336 }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                        Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
