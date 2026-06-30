@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Manajemen <span class="text-brand-500">Produk</span></h1>
            <p class="text-gray-500 dark:text-gray-400 font-medium mt-1">Kelola menu makanan dan minuman restoran Anda dengan mudah.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-gray-900 hover:bg-gray-800 dark:bg-brand-600 dark:hover:bg-brand-500 text-white px-5 py-2.5 rounded-xl transition-all shadow-[0_4px_15px_rgba(0,0,0,0.1)] dark:shadow-[0_4px_15px_rgba(239,68,68,0.3)] flex items-center gap-2 text-sm font-bold transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-white/50 dark:border-gray-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50/50 dark:bg-gray-700/30 border-b border-gray-100 dark:border-gray-700/50">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Produk</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Kategori</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Harga</th>
                        <th scope="col" class="px-8 py-5 text-left text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Stok</th>
                        <th scope="col" class="px-8 py-5 text-right text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-transparent divide-y divide-gray-100 dark:divide-gray-700/50">
                    @forelse($products as $product)
                        <tr class="hover:bg-brand-50/30 dark:hover:bg-brand-900/10 transition-colors duration-200">
                            <td class="px-8 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-4">
                                    <div class="h-14 w-14 flex-shrink-0 relative group">
                                        @if($product->image)
                                            <img class="h-14 w-14 rounded-2xl object-cover border-2 border-white dark:border-gray-800 shadow-md group-hover:scale-105 transition-transform" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-orange-100 to-red-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center text-brand-500 dark:text-brand-400 font-black text-xl border-2 border-white dark:border-gray-800 shadow-md group-hover:scale-105 transition-transform">
                                                {{ substr($product->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap">
                                <span class="px-3 py-1.5 inline-flex text-xs font-black tracking-wide uppercase rounded-xl shadow-sm border border-transparent 
                                    @if($product->category == 'makanan') bg-orange-50 text-orange-600 border-orange-100 dark:bg-orange-900/30 dark:text-orange-400 dark:border-orange-800/50
                                    @elseif($product->category == 'minuman') bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800/50
                                    @else bg-purple-50 text-purple-600 border-purple-100 dark:bg-purple-900/30 dark:text-purple-400 dark:border-purple-800/50 @endif">
                                    {{ ucfirst($product->category) }}
                                </span>
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap text-base text-gray-900 dark:text-gray-300 font-black">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap">
                                @if($product->stock == 0)
                                    <span class="inline-flex items-center gap-1.5 text-red-600 dark:text-red-400 font-bold text-sm bg-red-50 dark:bg-red-900/30 px-2.5 py-1 rounded-lg">
                                        <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div> Habis
                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="inline-flex items-center gap-1.5 text-orange-600 dark:text-orange-400 font-bold text-sm bg-orange-50 dark:bg-orange-900/30 px-2.5 py-1 rounded-lg">
                                        <div class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></div> {{ $product->stock }} (Menipis)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-gray-700 dark:text-gray-300 font-bold text-sm bg-gray-50 dark:bg-gray-700 px-2.5 py-1 rounded-lg">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div> {{ $product->stock }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 dark:text-blue-400 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 p-2.5 rounded-xl transition-all hover:scale-105" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 dark:text-red-400 dark:bg-red-900/20 dark:hover:bg-red-900/40 p-2.5 rounded-xl transition-all hover:scale-105" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-400">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada produk</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan produk baru.</p>
                                <div class="mt-6">
                                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Tambah Produk Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection