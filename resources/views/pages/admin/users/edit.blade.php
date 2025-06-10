@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                    Kembali
                </a>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Edit User</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Form untuk mengedit user.</p>
                    </div>
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="mt-5 space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email"
                                    value="{{ old('email', $user->email_222336) }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="relative">
                            <label for="role" class="block mb-1 text-sm font-medium text-slate-700">Select Role</label>
                            <select id="role" name="role" required
                                class="w-full border bg-slate-50 border-slate-200 rounded-lg p-3 focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 focus:outline-none text-sm">
                                <option value="" disabled>Select your role</option>
                                <option value="admin" {{ old('role', $user->role_222336) === 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="customer"
                                    {{ old('role', $user->role_222336) === 'customer' ? 'selected' : '' }}>
                                    Customer</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password (opsional) --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password
                                (kosongkan jika tidak ingin mengubah)</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
