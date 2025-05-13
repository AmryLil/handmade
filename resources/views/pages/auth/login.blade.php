<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Nusantara Craft</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 font-sans">
    <div class="relative flex items-center w-full justify-center min-h-screen py-12 px-4">
        <!-- Background Decoration -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-72 bg-slate-800 -skew-y-6 transform origin-top-right opacity-90">
            </div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-maroon-200 rounded-full opacity-20 -mr-20 -mb-20"></div>
            <div class="absolute top-1/4 left-10 w-32 h-32 bg-slate-200 rounded-full opacity-40"></div>
        </div>

        <!-- Login Container -->
        <div class="relative w-full max-w-md">
            <!-- Login Form Card -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-slate-100">
                <!-- Decorative Header -->
                <div class="relative h-28 bg-slate-800 overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" viewBox="0 0 800 200">
                            <path fill="#9A3412" fill-opacity="0.2"
                                d="M0,192L48,181.3C96,171,192,149,288,149.3C384,149,480,171,576,165.3C672,160,768,128,864,122.7C960,117,1056,139,1152,154.7C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                            </path>
                        </svg>
                    </div>
                    <div class="absolute w-full h-full flex items-center justify-center">
                        <div class="text-center text-white">
                            <h1 class="font-bold text-2xl tracking-wider">NURUL MADE</h1>
                            <p class="text-xs text-slate-300 mt-1">Handmade with love & tradition</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <!-- Title -->
                    <h2 class="text-center text-2xl font-bold text-slate-800 mb-2">Welcome Back</h2>
                    <p class="font-light text-center mb-6 text-maroon-600">Sign in to access your account</p>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-5 text-maroon-600 text-sm bg-maroon-50 p-3 rounded-lg border border-maroon-100">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input
                                    class="w-full border bg-slate-50 border-slate-200 rounded-lg p-3 pl-10 focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 focus:outline-none text-sm"
                                    type="email" name="email" placeholder="Email Address" required />
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    class="w-full border bg-slate-50 border-slate-200 rounded-lg p-3 pl-10 focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 focus:outline-none text-sm"
                                    type="password" name="password" placeholder="Password" required />
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="h-4 w-4 text-maroon-600 focus:ring-maroon-500 border-slate-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-slate-600">Remember me</label>
                            </div>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-maroon-600 hover:text-maroon-700">Forgot
                                    password?</a>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-maroon-600 rounded-lg text-white py-3 hover:bg-maroon-700 transition duration-300 font-semibold shadow-md mt-4">
                            Sign in
                        </button>
                    </form>

                    <!-- Signup Link -->
                    <div class="mt-6 text-center text-sm text-slate-600">
                        Don't have an account?
                        <a href="/register" class="text-maroon-600 font-semibold hover:underline">Create
                            Account</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
