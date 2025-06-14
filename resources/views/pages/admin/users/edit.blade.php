@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl border border-gray-300 shadow-sm transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 rounded-t-3xl">
                    <h2 class="text-xl font-semibold text-white">Edit User</h2>
                    <p class="text-blue-100 mt-1">Form untuk mengedit user dengan mudah dan cepat</p>
                </div>

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                            <span class="text-red-500">*</span>
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email_222336) }}"
                            required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                            placeholder="Masukkan alamat email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="group">
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" required
                            class="w-full border bg-gray-50 border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-600 focus:border-red-600 focus:outline-none text-sm">
                            <option value="" disabled>Select your role</option>
                            <option value="admin" {{ old('role', $user->role_222336) === 'admin' ? 'selected' : '' }}>
                                Admin</option>
                            <option value="customer" {{ old('role', $user->role_222336) === 'customer' ? 'selected' : '' }}>
                                Customer</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password (opsional) --}}
                    <div class="group">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password
                            (kosongkan jika tidak ingin mengubah)</label>
                        <input id="password" name="password" type="password"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-transparent rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none text-gray-900 placeholder-gray-400"
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl shadow-lg">
                            Perbarui User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
