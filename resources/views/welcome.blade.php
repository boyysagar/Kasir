<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mie Gamon - Pedasnya Bikin Susah Move On</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
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
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="antialiased bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-orange-50/50 via-gray-50 to-red-50/50 text-gray-800 overflow-x-hidden relative">
    
    <!-- Ambient Background Elements -->
    <div class="fixed inset-0 pointer-events-none -z-10">
        <div class="absolute -top-1/4 -right-1/4 w-[800px] h-[800px] rounded-full bg-gradient-to-tr from-brand-100/60 to-orange-100/60 blur-3xl mix-blend-multiply opacity-70 animate-slow-spin"></div>
        <div class="absolute top-1/4 -left-1/4 w-[600px] h-[600px] rounded-full bg-gradient-to-bl from-red-100/60 to-pink-100/60 blur-3xl mix-blend-multiply opacity-70 animate-slow-spin-reverse"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 py-4 bg-white/60 backdrop-blur-xl border-b border-white/20 shadow-[0_4px_30px_rgba(0,0,0,0.03)] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div
                    class="h-12 w-12 bg-white rounded-full p-1 shadow-md flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-2xl font-bold text-gray-900 tracking-tight">Mie Gamon</span>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-gray-900 text-white font-bold rounded-full shadow-lg hover:bg-gray-800 transition-transform active:scale-95 text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('transactions.index') }}" class="px-5 py-2.5 bg-brand-600 text-white font-bold rounded-full shadow-lg hover:bg-brand-700 transition-transform active:scale-95 text-sm">Pesanan Baru</a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-500 hover:text-red-600 transition-colors">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-block px-5 py-2.5 bg-brand-600 text-white font-bold rounded-full shadow-lg hover:bg-brand-700 transition-transform active:scale-95">Masuk Akun</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-40 pb-20 overflow-hidden min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block py-1 px-3 rounded-full bg-red-100 text-red-600 text-sm font-bold mb-6">🔥
                    Pedasnya Nampol!</span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight mb-6">
                    Rasakan <span class="text-brand-600">Sensasi Pedas</span> yang Bikin Nagih
                </h1>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-lg">
                    Mie Gamon hadir dengan resep rahasia yang memadukan pedas cabai pilihan dengan gurihnya bumbu
                    spesial. Siap bikin kamu gagal move on dari rasanya!
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#menu"
                        class="px-8 py-4 bg-gray-900 text-white font-bold rounded-xl shadow-xl shadow-gray-900/20 hover:bg-gray-800 transition-all transform hover:-translate-y-1 text-center">
                        Lihat Menu
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-white/80 backdrop-blur-sm text-gray-900 border border-gray-200/50 font-bold rounded-xl hover:bg-white transition-all transform hover:-translate-y-1 shadow-sm text-center">
                        Pesan Sekarang
                    </a>
                </div>
            </div>

            <div class="relative animate-float">
                <div class="relative z-10 bg-gradient-to-tr from-brand-500 via-brand-400 to-orange-400 rounded-[2.5rem] p-3 rotate-3 shadow-[0_20px_50px_rgba(225,29,72,0.3)] transition-transform hover:rotate-0 duration-500">
                    <div class="bg-white rounded-[2.2rem] overflow-hidden">
                        <!-- Placeholder Hero Image -->
                        <div
                            class="h-[500px] w-full bg-gray-200 flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1585032226651-759b368d7246?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80')] bg-cover bg-center transition-transform hover:scale-105 duration-700">
                            <div class="bg-gradient-to-t from-black/50 to-transparent inset-0 absolute"></div>
                        </div>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -bottom-10 -left-10 bg-white/90 backdrop-blur-md p-5 rounded-2xl shadow-xl z-20 animate-bounce cursor-default border border-white/50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 rounded-xl">
                            <span class="text-3xl">🌶️</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Tingkat Kepedasan</p>
                            <span class="font-bold text-gray-900 text-lg">Level 1-5</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Menu -->
    <section id="menu" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2 block">Our Favorites</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Menu Pilihan Spesial</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">Pilihan terbaik untuk memanjakan lidahmu. Hati-hati, rasanya bikin susah move on!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredProducts as $product)
                    <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-6 group hover:bg-white hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:border-brand-100 transition-all duration-500 transform hover:-translate-y-2">
                        <div class="h-56 rounded-2xl bg-orange-50 mb-6 overflow-hidden relative shadow-inner">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-6xl font-black text-orange-200">{{ substr($product->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-gray-700 shadow-sm">
                                Stok: {{ $product->stock }}
                            </div>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-2 group-hover:text-brand-600 transition-colors">{{ $product->name }}</h3>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-brand-600 font-black text-2xl tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-brand-600 group-hover:text-white transition-colors cursor-pointer shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-400">Belum ada menu yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center gap-3 mb-4 md:mb-0">
                <div class="h-10 w-10 bg-white rounded-full p-1 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-xl font-bold">Mie Gamon</span>
            </div>
            <div class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} Mie Gamon. Created by Boydo.Sagar_    
            </div>
        </div>
    </footer>
</body>

</html>