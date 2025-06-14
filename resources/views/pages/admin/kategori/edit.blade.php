@extends('layouts.admin')

@section('title', 'Edit Kategori Produk')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-red-500 flex items-center justify-center rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Edit Kategori Produk
                    </h1>
                </div>
                <p class="text-gray-600 text-lg">Perbarui informasi kategori dengan mudah dan cepat</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6">
                    <h2 class="text-xl font-semibold text-white">Informasi Kategori Produk</h2>
                    <p class="text-blue-100 mt-1">Update data kategori sesuai kebutuhan</p>
                </div>

                <form action="{{ route('admin.kategori_produk.update', $kategori->id_222336) }}" method="POST"
                    enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

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
                                <label for="nama_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Kategori
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="nama_222336" id="nama_222336"
                                        value="{{ old('nama_222336', $kategori->nama_222336) }}"
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
                                    placeholder="Ceritakan tentang kategori ini, fitur unggulan, dan keunikannya...">{{ old('deskripsi_222336', $kategori->deskripsi_222336) }}</textarea>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="group">
                                <label for="path_img_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Gambar Kategori
                                </label>
                                <div class="mt-1 flex items-center">
                                    @if ($kategori->path_img_222336)
                                        <div class="mb-4 relative">
                                            <img src="{{ Storage::url($kategori->path_img_222336) }}"
                                                alt="{{ $kategori->nama_222336 }}"
                                                class="w-48 h-48 object-cover rounded-xl shadow-lg">
                                            <button type="button" id="remove-image"
                                                class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="w-full">
                                        <input type="file" name="path_img_222336" id="path_img_222336"
                                            class="focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-xl"
                                            accept="image/*">
                                        <p class="mt-1 text-xs text-gray-500 bg-gray-50 rounded-lg p-3">
                                            <span class="font-medium">Format:</span> PNG, JPG, JPEG, GIF •
                                            <span class="font-medium">Ukuran Maksimal:</span> 2MB
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah
                                            gambar</p>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label for="tags_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tags
                                </label>
                                <input type="text" name="tags_222336" id="tags_222336"
                                    value="{{ old('tags_222336', $kategori->tags_222336) }}"
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
                            Perbarui Kategori
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
