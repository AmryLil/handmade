@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Tambah Produk</h1>
                <p class="mt-1 text-sm text-gray-600">Tambahkan produk baru ke katalog.</p>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="nama_222336" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                            <div class="mt-1">
                                <input type="text" name="nama_222336" id="nama_222336" value="{{ old('nama_222336') }}"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('nama_222336')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="kategori_id_222336" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <div class="mt-1">
                                <select id="kategori_id_222336" name="kategori_id_222336"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id_222336 }}"
                                            {{ old('kategori_id_222336') == $kat->id_222336 ? 'selected' : '' }}>
                                            {{ $kat->nama_222336 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kategori_id_222336')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="harga_222336" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <div class="mt-1">
                                <input type="number" name="harga_222336" id="harga_222336"
                                    value="{{ old('harga_222336') }}"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('harga_222336')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="jumlah_222336" class="block text-sm font-medium text-gray-700">Stok</label>
                            <div class="mt-1">
                                <input type="number" name="jumlah_222336" id="jumlah_222336"
                                    value="{{ old('jumlah_222336') }}"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('jumlah_222336')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                            <div class="mt-1 flex items-center">
                                <div class="preview-image-container hidden">
                                    <img id="preview-image" src="#" alt="Preview"
                                        class="h-32 w-32 object-cover rounded-md">
                                    <button type="button" id="remove-image"
                                        class="mt-2 inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Batal
                                    </button>
                                </div>

                                <div class="upload-button-container">
                                    <label for="image-upload"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                        <span>Upload gambar</span>
                                        <input id="image-upload" name="image" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">PNG, JPG, JPEG atau GIF. Maksimal 2MB.</p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="deskripsi_222336" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <div class="mt-1">
                                <textarea id="deskripsi_222336" name="deskripsi_222336" rows="4"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('deskripsi_222336') }}</textarea>
                            </div>
                            @error('deskripsi_222336')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.produk.index') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-red-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
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
    @endpush
@endsection
