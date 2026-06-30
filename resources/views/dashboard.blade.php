@extends('layouts.app')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Admin</h1>
                <p class="text-gray-500 mt-1">Laporan penjualan harian.</p>
            </div>

            <!-- Date Filter -->
            <form action="{{ route('dashboard') }}" method="GET" class="md:ml-auto">
                <div class="flex items-center gap-2 bg-white p-1.5 rounded-xl border border-gray-200 shadow-sm">
                    <div class="pl-2 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()"
                        class="border-none text-sm font-medium text-gray-700 focus:ring-0 rounded-lg cursor-pointer bg-transparent">
                </div>
            </form>

            <div>
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $selectedDate == date('Y-m-d') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    <span
                        class="w-2 h-2 rounded-full {{ $selectedDate == date('Y-m-d') ? 'bg-green-500' : 'bg-gray-500' }} mr-2"></span>
                    {{ $selectedDate == date('Y-m-d') ? 'Hari Ini' : 'Arsip' }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <!-- Stat Card 1 -->
        <div class="bg-gradient-to-br from-brand-500 to-orange-400 rounded-3xl shadow-[0_8px_30px_rgba(239,68,68,0.2)] p-8 text-white relative overflow-hidden group transition-all duration-300 hover:shadow-[0_8px_40px_rgba(239,68,68,0.3)] hover:-translate-y-1">
            <div class="absolute right-0 top-0 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 transition-transform duration-700">
                <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <div class="relative z-10">
                <p class="text-white/80 font-bold text-sm uppercase tracking-widest mb-1">Total Penjualan</p>
                <div class="flex items-baseline mt-2">
                    <span class="text-5xl font-black tracking-tight">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
                </div>
                <div class="mt-6 flex items-center gap-2">
                    <span class="text-xs font-bold text-brand-900 bg-white/30 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-white/20 shadow-sm">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-white/50 dark:border-gray-700/50 p-8 relative overflow-hidden group hover:shadow-[0_8px_40px_rgba(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-500 font-medium text-sm uppercase tracking-wider">Produk Terlaris</p>
                    @if($bestSellingProduct)
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $bestSellingProduct->name }}</h3>
                        <div class="flex items-center mt-2 text-green-600 text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            <span>{{ $bestSellingProduct->total_sold }} porsi terjual</span>
                        </div>
                    @else
                        <p class="text-2xl font-bold text-gray-400 mt-2">Belum ada data</p>
                    @endif
                </div>
                <div class="p-3 bg-orange-100 rounded-xl text-orange-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-white/50 dark:border-gray-700/50 overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700/50 flex justify-between items-center bg-white/50 dark:bg-gray-800/50">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-brand-50 dark:bg-brand-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">Transaksi Terbaru</h3>
            </div>
            <button class="text-sm text-brand-600 font-bold hover:text-brand-700 hover:underline transition-colors">Lihat Semua</button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Waktu
                        </th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kasir
                        </th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Detail
                            Pesanan</th>
                        <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-transparent divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-brand-50/30 dark:hover:bg-brand-900/10 transition-colors duration-200">
                            <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col">
                                    <span
                                        class="font-bold text-gray-700 dark:text-gray-300">{{ $transaction->created_at->format('d M Y') }}</span>
                                    <span class="text-xs mt-0.5">{{ $transaction->created_at->format('H:i') }} WIB</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-sm border border-gray-200 dark:border-gray-600">
                                    {{ $transaction->user->name }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm text-gray-900 dark:text-white font-bold">{{ $transaction->product->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"><span class="font-semibold text-brand-600">{{ $transaction->quantity }}</span> porsi</div>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap">
                                <span class="text-base font-black text-brand-600 dark:text-brand-400">Rp
                                    {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <p>Belum ada transaksi pada tanggal ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection