@extends('layouts.admin')

@section('title', 'Tambah User')

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
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah User</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Form untuk menambahkan user baru.</p>
                    </div>
                    <form action="{{ route('admin.users.store') }}" method="POST" class="mt-5 space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                            </div>
                        </div>

                        <div class="relative">
                            <label for="role" class="block mb-1 text-sm font-medium text-slate-700">Select
                                Role</label>
                            <select id="role" name="role" required
                                class="w-full border bg-slate-50 border-slate-200 rounded-lg p-3 focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 focus:outline-none text-sm">
                                <option value="" disabled selected>Select your role</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
