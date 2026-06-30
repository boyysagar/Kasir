@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-[calc(100vh-200px)] relative">
        <div class="w-full max-w-md bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl p-10 rounded-[2.5rem] shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-white/50 dark:border-gray-700/50">
            <div class="text-center mb-8">
                <div class="inline-block p-4 rounded-3xl bg-gradient-to-br from-brand-50 to-orange-50 dark:from-gray-700 dark:to-gray-600 mb-6 shadow-inner">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Mie Gamon"
                        class="h-20 w-auto hover:scale-110 transition-transform duration-500">
                </div>
                <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight">Welcome Back</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 font-medium">Masuk untuk mengelola sistem Mie Gamon</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[11px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-1.5">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="w-full rounded-2xl bg-gray-50/50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 shadow-sm p-3.5 transition-all dark:text-white font-medium"
                        placeholder="admin@gmail.com">
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-2xl bg-gray-50/50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 shadow-sm p-3.5 transition-all dark:text-white font-medium"
                        placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-[0_4px_15px_rgba(239,68,68,0.2)] text-base font-black text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all transform hover:-translate-y-1 tracking-wide uppercase">
                        Masuk Ke Sistem
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700/50">
                <div class="bg-brand-50/50 dark:bg-brand-900/10 p-5 rounded-2xl text-xs text-gray-600 dark:text-gray-400 border border-brand-100 dark:border-brand-900/30">
                    <p class="font-black text-brand-600 dark:text-brand-400 mb-3 uppercase tracking-wider">Akun Demo Akses</p>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center bg-white dark:bg-gray-800 p-2.5 rounded-xl shadow-sm">
                            <span class="font-bold">Admin:</span>
                            <span class="font-mono font-medium bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded">admin@gmail.com / password</span>
                        </div>
                        <div class="flex justify-between items-center bg-white dark:bg-gray-800 p-2.5 rounded-xl shadow-sm">
                            <span class="font-bold">Kasir:</span>
                            <span class="font-mono font-medium bg-gray-100 dark:bg-gray-900 px-2 py-1 rounded">kasir@gmail.com / password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection