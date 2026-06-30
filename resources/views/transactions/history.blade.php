@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Riwayat <span class="text-brand-500">Transaksi Saya</span></h1>
            <p class="text-gray-500 dark:text-gray-400 font-medium mt-1">Daftar transaksi yang pernah Anda tangani.</p>
        </div>
        <a href="{{ route('transactions.index') }}"
            class="bg-gray-900 hover:bg-gray-800 dark:bg-brand-600 dark:hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl transition-all shadow-[0_4px_15px_rgba(0,0,0,0.1)] dark:shadow-[0_4px_15px_rgba(239,68,68,0.3)] flex items-center text-sm font-bold transform hover:-translate-y-0.5">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Transaksi Baru
        </a>
    </div>

    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-white/50 dark:border-gray-700/50 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700/50">
            <thead class="bg-gray-50/50 dark:bg-gray-700/30 border-b border-gray-100 dark:border-gray-700/50">
                <tr>
                    <th class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Tanggal &
                        Invoice</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Nama
                        Pelanggan</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Detail
                        Pesanan</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Total
                        Tagihan</th>
                    <th class="px-8 py-5 text-right text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-transparent divide-y divide-gray-100 dark:divide-gray-700/50">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-brand-50/30 dark:hover:bg-brand-900/10 transition-colors duration-200">
                        <td class="px-8 py-5 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $transaction->created_at->format('d M Y H:i') }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 font-mono mt-1 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded inline-block">{{ $transaction->invoice_code }}</div>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300 font-bold">
                            {{ $transaction->customer_name ?? '-' }}
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-sm text-gray-900 dark:text-gray-300"><span class="font-black text-brand-600 dark:text-brand-400">{{ $transaction->total_qty }}</span> Menu
                            </div>
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap text-base font-black text-brand-600 dark:text-brand-400">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-5 whitespace-nowrap text-right text-sm">
                            <a href="{{ route('transactions.print', $transaction->id) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all text-xs font-black uppercase tracking-widest shadow-sm transform hover:scale-105 border border-gray-200 dark:border-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak Struk
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <p class="font-medium">Belum ada riwayat transaksi</p>
                            <p class="text-sm mt-1">Transaksi yang Anda lakukan akan muncul di sini</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection