@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-8 h-8 bg-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        Tambah Produk Baru
                    </h1>
                </div>
                <p class="text-gray-600 text-lg">Buat produk baru dengan desain yang elegan dan mudah digunakan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6">
                    <h2 class="text-xl font-semibold text-white">Informasi Produk</h2>
                    <p class="text-blue-100 mt-1">Lengkapi data produk dengan detail yang akurat</p>
                </div>

                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Kode Produk -->
                            <div class="group">
                                <label for="id_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kode Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="id_222336" id="id_222336" value="{{ old('id_222336') }}"
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                        placeholder="Masukkan kode unik produk">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('id_222336')
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Nama Produk -->
                            <div class="group">
                                <label for="nama_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Produk
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="nama_222336" id="nama_222336"
                                        value="{{ old('nama_222336') }}"
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                        placeholder="Nama produk yang menarik">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('nama_222336')
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="group">
                                <label for="kategori_id_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Kategori
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select id="kategori_id_222336" name="kategori_id_222336"
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 appearance-none cursor-pointer">
                                        <option value="">Pilih Kategori Produk</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id_222336 }}"
                                                {{ old('kategori_id_222336') == $kat->id_222336 ? 'selected' : '' }}>
                                                {{ $kat->nama_222336 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('kategori_id_222336')
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Harga & Stok -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="group">
                                    <label for="harga_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Harga (Rp)
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="harga_222336" id="harga_222336"
                                            value="{{ old('harga_222336') }}"
                                            class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400 pl-10"
                                            placeholder="0">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="text-gray-500 text-sm font-medium">Rp</span>
                                        </div>
                                    </div>
                                    @error('harga_222336')
                                        <p class="mt-2 text-sm text-red-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label for="jumlah_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Stok
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="jumlah_222336" id="jumlah_222336"
                                            value="{{ old('jumlah_222336') }}"
                                            class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                                            placeholder="0">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 text-sm">pcs</span>
                                        </div>
                                    </div>
                                    @error('jumlah_222336')
                                        <p class="mt-2 text-sm text-red-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Gambar Produk -->
                            <div class="group">
                                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Gambar Produk
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
                                        <label for="image-upload"
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
                                            <input id="image-upload" name="image" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                <p class="mt-3 text-sm text-gray-500 bg-gray-50 rounded-lg p-3">
                                    <span class="font-medium">Format:</span> PNG, JPG, JPEG, GIF •
                                    <span class="font-medium">Ukuran Maksimal:</span> 2MB
                                </p>
                                @error('image')
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="group">
                                <label for="deskripsi_222336" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Deskripsi Produk
                                </label>
                                <textarea id="deskripsi_222336" name="deskripsi_222336" rows="6"
                                    class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400 resize-none"
                                    placeholder="Ceritakan tentang produk ini, fitur unggulan, dan keunikannya...">{{ old('deskripsi_222336') }}</textarea>
                                @error('deskripsi_222336')
                                    <p class="mt-2 text-sm text-red-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('admin.produk.index') }}"
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
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('image-upload');
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
