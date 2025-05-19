@extends('layouts.admin')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Tambah Kategori Produk</h1>
                <a href="{{ route('admin.kategori_produk.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <div class="mt-6 bg-white shadow overflow-hidden rounded-lg">
                <form action="{{ route('admin.kategori_produk.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-6">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="nama_222336" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_222336" id="nama_222336" value="{{ old('nama_222336') }}"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>
                    </div>

                    <div class="mb-6">
                        <label for="deskripsi_222336" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi_222336" id="deskripsi_222336" rows="4"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            required>{{ old('deskripsi_222336') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="path_img_222336" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                        <div class="mt-1 flex items-center">
                            <div class="w-full">
                                <input type="file" name="path_img_222336" id="path_img_222336"
                                    class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300">
                                <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPEG, PNG, JPG, GIF (Maks. 2MB)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="tags_222336" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" name="tags_222336" id="tags_222336" value="{{ old('tags_222336') }}"
                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Pisahkan dengan koma, mis: elektronik,gadget,computer">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
