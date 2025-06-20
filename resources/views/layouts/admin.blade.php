<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modern Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }

        .nav-item {
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #dc2626;
            transform: scaleY(0);
            transform-origin: bottom;
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Sidebar -->
    <div x-data="{ sidebarOpen: false }" class="relative flex min-h-screen">
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar -->
        <div x-show="sidebarOpen" x-cloak
            class="fixed inset-y-0 left-0 z-30 w-72 sidebar-gradient shadow-2xl lg:hidden">
            <div class="flex h-full flex-col">
                <!-- Logo Section -->
                <div class="flex h-20 items-center justify-center border-b border-slate-600/30 px-6">
                    <div class="text-center">
                        <h1 class="text-3xl font-black text-white tracking-tight">
                            NURUL<span class="text-red-400">MADE</span>
                        </h1>
                        <p class="text-xs text-slate-300 mt-1 font-medium">Admin Dashboard</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-6">
                    <div class="px-6 pb-4">
                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Management</p>
                    </div>

                    <div class="space-y-2 px-3">


                        <!-- Produk - Active State -->
                        <a href="{{ route('admin.produk.index') }}"
                            class="nav-item active group flex items-center px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-lg">
                            <div class="mr-4 p-2 bg-white/20 rounded-lg">
                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span>Produk</span>

                        </a>

                        <!-- Kategori -->
                        <a href="{{ route('admin.kategori_produk.index') }}"
                            class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                            <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                </svg>
                            </div>
                            <span>Kategori</span>
                        </a>

                        <!-- Users -->
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                            <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                </svg>
                            </div>
                            <span>Manajemen Users</span>
                        </a>

                        <!-- Orders -->
                        <a href="{{ route('admin.transaksi.index') }}"
                            class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                            <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span>Pesanan</span>

                        </a>

                        <!-- Reports -->
                        <a href="{{ route('admin.laporan') }}"
                            class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                            <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <span>Laporan</span>
                        </a>
                    </div>

                    <!-- Settings Section -->
                    <div class="px-6 pt-6 pb-4">
                        <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Settings</p>
                    </div>


                </nav>

                <!-- User Profile Section -->
                <div class="border-t border-slate-600/30 p-4">
                    <div class="flex items-center px-4 py-3 bg-slate-700/30 rounded-xl">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center text-white font-bold text-sm">
                            AD
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-semibold text-white">Admin User</p>
                            <p class="text-xs text-slate-300">admin@nurulmade.com</p>
                        </div>
                        <button class="text-slate-400 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden fixed lg:flex lg:flex-shrink-0 z-20">
            <div class="flex w-72 flex-col">
                <div class="flex flex-1 flex-col min-h-screen sidebar-gradient shadow-2xl">
                    <!-- Logo Section -->
                    <div class="flex h-20 items-center justify-center border-b border-slate-600/30 px-6">
                        <div class="text-center">
                            <h1 class="text-3xl font-black text-white tracking-tight">
                                NURUL<span class="text-red-400">MADE</span>
                            </h1>
                            <p class="text-xs text-slate-300 mt-1 font-medium">Admin Dashboard</p>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex-1 overflow-y-auto py-6">
                        <div class="px-6 pb-4">
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Management</p>
                        </div>

                        <div class="space-y-2 px-3">
                            <!-- Dashboard -->

                            <!-- Produk - Active State -->
                            <a href="{{ route('admin.produk.index') }}"
                                class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                                <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span>Produk</span>

                            </a>

                            <!-- Kategori -->
                            <a href="{{ route('admin.kategori_produk.index') }}"
                                class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                                <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                    <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                    </svg>
                                </div>
                                <span>Kategori</span>
                            </a>

                            <!-- Users -->
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                                <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                    <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                                    </svg>
                                </div>
                                <span>Manajemen Users</span>
                            </a>

                            <!-- Orders -->
                            <a href="{{ route('admin.transaksi.index') }}"
                                class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                                <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                    <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span>Pesanan</span>

                            </a>

                            <!-- Reports -->
                            <a href="{{ route('admin.laporan') }}"
                                class="nav-item group flex items-center px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl">
                                <div class="mr-4 p-2 bg-slate-700 rounded-lg group-hover:bg-red-600">
                                    <svg class="h-5 w-5 text-slate-300 group-hover:text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                    </svg>
                                </div>
                                <span>Laporan</span>
                            </a>
                        </div>


                    </nav>

                    <!-- User Profile Section -->
                    <div class="border-t border-slate-600/30 p-4">
                        <div class="flex items-center px-4 py-3 bg-slate-700/30 rounded-xl">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                AD
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-semibold text-white">Admin User</p>
                                <p class="text-xs text-slate-300">admin@nurulmade.com</p>
                            </div>
                            <button class="text-slate-400 hover:text-white">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-1 flex-col">
            <!-- Top bar -->
            <div
                class="flex-shrink-0 bg-white border-b border-gray-200 shadow-sm fixed justify-end min-w-max w-full z-10">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" type="button"
                        class="lg:hidden text-gray-700 hover:text-red-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <div class="text-gray-800 font-medium">
                        Administrator Panel
                    </div>

                    <!-- Header actions -->
                    <div class="flex items-center ">
                        <!-- User dropdown -->
                        <div x-data="{ userMenuOpen: false }" class="ml-4 relative">
                            <button @click="userMenuOpen = !userMenuOpen" type="button"
                                class="flex items-center gap-x-2 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600 border border-gray-200">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                    AD
                                </div>
                                <span>Admin User</span>
                                <svg class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-lg bg-white py-2 shadow-xl ring-1 ring-black ring-opacity-5 border border-gray-100">

                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">

                                    {{-- TAMBAHKAN BARIS INI --}}
                                    @csrf

                                    <button type="submit"
                                        class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                        <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content area -->
            <main class="flex-1 p-6">
                <div class="max-w-7xl mx-auto lg:ml-[270px] pt-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
