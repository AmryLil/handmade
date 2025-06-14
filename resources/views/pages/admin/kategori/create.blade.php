@extends('layouts.admin')

@section('title', 'Tambah Kategori Produk')

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
                        Tambah Kategori Produk Baru
                    </h1>
                </div>
                <p class="text-gray-600 text-lg">Buat kategori produk baru dengan desain yang elegan dan mudah digunakan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6">
                    <h2 class="text-xl font-semibold text-white">Informasi Kategori Produk</h2>
                    <p class="text-blue-100 mt-1">Lengkapi data kategori produk dengan detail yang akurat</p>
                </div>

                <form action="{{ route('admin.kategori_produk.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8">
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

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="id_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kode Kategori
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="id_222336" id="id_222336" value="{{ old('id_222336') }}"
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                        placeholder="Masukkan kode unik kategori">
                                </div>
                            </div>

                            <div class="group">
                                <label for="nama_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Kategori
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="nama_222336" id="nama_222336"
                                        value="{{ old('nama_222336') }}"
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                        placeholder="Nama kategori yang menarik">
                                </div>
                            </div>

                            <div class="group">
                                <label for="deskripsi_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Deskripsi
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea name="deskripsi_222336" id="deskripsi_222336" rows="6"
                                    class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400 resize-none"
                                    placeholder="Ceritakan tentang kategori ini, fitur unggulan, dan keunikannya...">{{ old('deskripsi_222336') }}</textarea>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="path_img_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Gambar Kategori
                                </label>
                                <div class="mt-1">
                                    <div class="preview-image-container hidden mb-4">
                                        <div class="relative">
                                            <img id="preview-image" src="#" alt="Preview"
                                                class="w-full h-48 object-cover rounded-xl shadow-lg">
                                            <button type="button" id="remove-image"
                                                class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="upload-button-container">
                                        <label for="path_img_222336"
                                            class="relative cursor-pointer bg-gradient-to-r from-blue-50 to-purple-50 hover:from-blue-100 hover:to-purple-100 border-2 border-dashed border-blue-300 rounded-xl p-8 flex flex-col items-center justify-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="text-blue-600 font-semibold text-lg mb-2">Upload Gambar</span>
                                            <span class="text-gray-500 text-sm">Klik untuk memilih gambar</span>
                                            <input id="path_img_222336" name="path_img_222336" type="file"
                                                class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm text-gray-500 bg-gray-50 rounded-lg p-3">
                                    <span class="font-medium">Format:</span> PNG, JPG, JPEG, GIF •
                                    <span class="font-medium">Ukuran Maksimal:</span> 2MB
                                </p>
                            </div>

                            <div class="group">
                                <label for="tags_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tags
                                </label>
                                <input type="text" name="tags_222336" id="tags_222336"
                                    value="{{ old('tags_222336') }}"
                                    class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                    placeholder="Pisahkan dengan koma, mis: elektronik,gadget,computer">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('admin.kategori_produk.index') }}"
                            class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl border border-gray-300 shadow-sm">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('path_img_222336');
            const previewImage = document.getElementById('preview-image');
            const previewContainer = document.querySelector('.preview-image-container');
            const uploadContainer = document.querySelector('.upload-button-container');
            const removeButton = document.getElementById('remove-image');

            imageUpload.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            });

            removeButton.addEventListener('click', function() {
                imageUpload.value = '';
                previewContainer.classList.add('hidden');
            });
        });
    </script>
@endsection
