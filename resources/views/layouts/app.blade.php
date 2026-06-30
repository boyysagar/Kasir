<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mie Gamon - Pedasnya Bikin Susah Move On</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#881337',
                        }
                    },
                    animation: {
                        'slow-spin': 'spin 20s linear infinite',
                        'slow-spin-reverse': 'spin 25s linear infinite reverse',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        @media print {

            nav,
            footer,
            .no-print {
                display: none !important;
            }

            main {
                padding: 0;
            }

            body {
                background-color: white;
            }
        }
    </style>
</head>

<body class="bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-orange-50/50 via-gray-50 to-red-50/50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 text-gray-800 dark:text-gray-100 min-h-screen flex flex-col transition-colors duration-300 relative">
    <!-- Ambient Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-1/2 -right-1/4 w-[1000px] h-[1000px] rounded-full bg-gradient-to-tr from-brand-100/40 to-orange-100/40 dark:from-brand-900/20 dark:to-orange-900/20 blur-3xl mix-blend-multiply dark:mix-blend-screen opacity-70 animate-slow-spin"></div>
        <div class="absolute -bottom-1/2 -left-1/4 w-[800px] h-[800px] rounded-full bg-gradient-to-bl from-red-100/40 to-pink-100/40 dark:from-red-900/20 dark:to-pink-900/20 blur-3xl mix-blend-multiply dark:mix-blend-screen opacity-70 animate-slow-spin-reverse"></div>
    </div>

    <nav class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-800/50 shadow-[0_4px_30px_rgba(0,0,0,0.03)] text-gray-800 dark:text-gray-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <div class="shrink-0 flex items-center gap-2">
                        <!-- Logo Image -->
                        <a href="{{ url('/') }}"
                            class="h-10 w-10 flex items-center justify-center overflow-hidden transition-transform transform hover:scale-105">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </a>
                        <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">Mie Gamon</span>
                    </div>

                    @auth
                        <div class="hidden sm:flex space-x-2">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-red-50 text-brand-600 font-bold' : 'text-gray-600 hover:text-brand-600 hover:bg-gray-50' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('products.index') }}"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('products.*') ? 'bg-red-50 text-brand-600 font-bold' : 'text-gray-600 hover:text-brand-600 hover:bg-gray-50' }}">
                                    Produk
                                </a>
                            @endif
                            @if(auth()->user()->role === 'kasir')
                                <a href="{{ route('transactions.index') }}"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('transactions.index') ? 'bg-red-50 text-brand-600 font-bold' : 'text-gray-600 hover:text-brand-600 hover:bg-gray-50' }}">
                                    Transaksi
                                </a>
                                <a href="{{ route('transactions.history') }}"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request()->routeIs('transactions.history') ? 'bg-red-50 text-brand-600 font-bold' : 'text-gray-600 hover:text-brand-600 hover:bg-gray-50' }}">
                                    Riwayat
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                @auth
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:flex flex-col items-end mr-2">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span
                                class="text-[10px] text-brand-600 bg-red-50 dark:bg-brand-900/30 px-2 py-0.5 rounded-full uppercase tracking-wider border border-red-100 dark:border-brand-800">{{ Auth::user()->role }}</span>
                        </div>
                        
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" type="button"
                            class="p-2 rounded-full text-gray-400 hover:text-brand-600 hover:bg-gray-100 dark:hover:text-brand-400 dark:hover:bg-gray-700 focus:outline-none transition-all mr-1"
                            title="Ubah Tema">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="p-2 rounded-full text-gray-400 hover:text-red-600 hover:bg-red-50 focus:outline-none transition-all transform hover:rotate-180"
                                title="Keluar Aplikasi">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="no-print mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-green-700">
                            {!! session('success') !!}
                        </p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="no-print mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm leading-5 font-medium text-red-800">
                                Terdapat beberapa kesalahan
                            </h3>
                            <ul class="mt-2 text-sm leading-5 text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-white/60 dark:bg-gray-900/60 backdrop-blur-lg border-t border-gray-200/50 dark:border-gray-800/50 py-8 mt-auto transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">&copy; {{ date('Y') }} Mie Gamon. Dibuat dengan <span
                    class="text-brand-500 animate-pulse inline-block">♥</span> dari rasa pedas yang membekas.</p>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon?.classList.remove('hidden');
            document.documentElement.classList.add('dark');
        } else {
            themeToggleDarkIcon?.classList.remove('hidden');
            document.documentElement.classList.remove('dark');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn?.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>

</html>