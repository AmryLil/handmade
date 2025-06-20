@extends('layouts.admin')

@section('title', 'Detail User')

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
                        Detail User
                    </h1>
                </div>
                <p class="text-gray-600 text-lg">Informasi lengkap tentang user</p>
            </div>

            <!-- Content Card -->
            <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 rounded-t-3xl">
                    <h2 class="text-xl font-semibold text-white">Detail User</h2>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="col-span-1 space-y-6">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">{{ $user->email_222336 }}</p>
                            <p class="text-gray-700 text-lg leading-relaxed"><strong>Role:</strong> {{ $user->role_222336 }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-4 sm:px-6 flex justify-end space-x-4">
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-wider hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-semibold text-white uppercase tracking-wider hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
