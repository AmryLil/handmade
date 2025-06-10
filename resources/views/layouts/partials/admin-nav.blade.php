<!-- Admin Navigation Menu -->
<nav class="flex-1 overflow-y-auto py-4">
    <div class="px-4 pb-2">
        <p class="text-xs font-semibold text-slate-950 uppercase tracking-wider">Manajemen</p>
    </div>

    <div class="space-y-1">


        <a href="{{ route('admin.produk.index') }}"
            class="{{ request()->routeIs('admin.produk*') ? 'bg-red-700 text-white' : 'text-slate-950 hover:bg-red-700 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.produk*') ? 'text-white' : 'text-slate-900 group-hover:text-white' }}"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd" />
            </svg>
            Produk
        </a>

        <a href="{{ route('admin.kategori_produk.index') }}"
            class="{{ request()->routeIs('admin.kategori*') ? 'bg-red-700 text-white' : 'text-slate-950 hover:bg-red-700 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.kategori*') ? 'text-white' : 'text-slate-900 group-hover:text-white' }}"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            Kategori
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="{{ request()->routeIs('admin.users.*') ? 'bg-red-700 text-white' : 'text-slate-950 hover:bg-red-700 hover:text-white' }} group flex items-center px-4 py-2 text-sm font-medium">
            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-900 group-hover:text-white' }}"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            Manajemen Users
        </a>

    </div>


</nav>
