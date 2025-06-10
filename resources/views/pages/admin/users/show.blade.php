@extends('layouts.admin')

@section('title', 'Detail User')

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
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Detail User</h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>Informasi detail user.</p>
                    </div>
                    <div class="mt-5 space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <p class="text-sm text-gray-500">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
