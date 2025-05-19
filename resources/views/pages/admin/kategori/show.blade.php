@extends('layouts.admin')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Detail Kategori Produk</h1>
                <a href="{{ route('admin.kategori_produk.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <div class="mt-6 bg-white shadow overflow-hidden rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $kategori->nama_222336 }}
                    </h3>
                    @if ($kategori->tags_222336)
                        <div class="mt-1 max-w-2xl text-sm text-gray-500">
                            Tags: {{ $kategori->tags_222336 }}
                        </div>
                    @endif
                </div>

                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Gambar
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($kategori->path_img_222336)
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-48 w-48">
                                            <img class="h-48 w-48 object-cover rounded-md"
                                                src="{{ Storage::url($kategori->path_img_222336) }}"
                                                alt="{{ $kategori->nama_222336 }}">
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                Deskripsi
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $kategori->deskripsi_222336 }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="px-4 py-4 sm:px-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.kategori_produk.edit', $kategori->id_222336) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-700 transition">
                        Edit
                    </a>
                    <form action="{{ route('admin.kategori_produk.destroy', $kategori->id_222336) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-700 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
