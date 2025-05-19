<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Sidebar -->
    <div x-data="{ sidebarOpen: false }" class="relative flex min-h-screen">
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

        <!-- Sidebar -->
        <div x-show="sidebarOpen" x-cloak
            class="fixed inset-y-0 left-0 z-30 w-64 transform bg-white shadow-lg transition duration-300 lg:hidden">
            <div class="flex h-full flex-col">
                <!-- Logo -->
                <div class="flex h-16 items-center justify-center border-b border-gray-100 bg-white px-6">
                    <h1 class="text-2xl  text-red-600 font-bold">NURUL<span class="text-gray-800">MADE</span>
                    </h1>
                </div>

                <!-- Navigation -->
                @include('layouts.partials.admin-nav')
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex w-64 flex-col">
                <div class="flex flex-1 flex-col min-h-screen bg-white shadow-lg">
                    <!-- Logo -->
                    <div class="flex h-16 items-center justify-center border-b border-gray-100 px-6">
                        <h1 class="text-2xl  text-red-600 font-bold">NURUL<span class="text-gray-800">MADE</span>
                        </h1>
                    </div>

                    <!-- Navigation -->
                    @include('layouts.partials.admin-nav')
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-1 flex-col">
            <!-- Top bar -->
            <div class="flex-shrink-0 bg-white border-b border-gray-100 shadow-sm">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" type="button"
                        class="lg:hidden text-gray-700 hover:text-red-600 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <div class="text-gray-800 font-medium">
                        Administrator
                    </div>

                    <!-- Header actions -->
                    <div class="flex items-center">
                        <!-- User dropdown -->
                        <div x-data="{ userMenuOpen: false }" class="ml-4 relative">
                            <button @click="userMenuOpen = !userMenuOpen" type="button"
                                class="flex items-center gap-x-2 rounded-full px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600 transition-colors border border-gray-200">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="userMenuOpen" x-cloak @click.away="userMenuOpen = false"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">Your
                                    Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">Log
                                        Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="flex-1">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @stack('scripts')
</body>

</html>
