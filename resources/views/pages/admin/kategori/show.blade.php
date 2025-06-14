@extends('layouts.admin')

@section('title', 'Detail Kategori Produk')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-red-500 flex items-center justify-center rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Detail Kategori Produk
                    </h1>
                </div>
                <p class="text-gray-600 text-lg">Informasi lengkap tentang kategori produk</p>
            </div>

            <!-- Content Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 rounded-t-3xl">
                    <h2 class="text-xl font-semibold text-white">Detail Kategori</h2>
                    @if ($kategori->tags_222336)
                        <p class="text-blue-100 mt-1">Tags: {{ $kategori->tags_222336 }}</p>
                    @endif
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="col-span-1">
                            @if ($kategori->path_img_222336)
                                <img src="{{ Storage::url($kategori->path_img_222336) }}" alt="{{ $kategori->nama_222336 }}"
                                    class="w-full h-64 object-cover rounded-xl shadow-lg">
                            @else
                                <div
                                    class="w-full h-64 bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <i class="fas fa-image text-gray-400 text-6xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-span-2 space-y-6">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $kategori->nama_222336 }}</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">{{ $kategori->deskripsi_222336 }}</p>

                            <div class="flex space-x-4">
                                <a href="{{ route('admin.kategori_produk.edit', $kategori->id_222336) }}"
                                    class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-wider hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <form action="{{ route('admin.kategori_produk.destroy', $kategori->id_222336) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-wider hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                                        <i class="fas fa-trash mr-2"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
