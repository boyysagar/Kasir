@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row gap-8 h-[calc(100vh-100px)]">
        <div class="md:w-2/3 flex flex-col h-full">
            <div class="mb-6 shrink-0 bg-white/60 dark:bg-gray-800/60 backdrop-blur-xl p-6 rounded-3xl border border-white/50 dark:border-gray-700/50 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Kasir <span class="text-brand-500">POS</span></h1>
                        <p class="text-gray-500 dark:text-gray-400 font-medium mt-1">Sistem Point of Sales Premium</p>
                    </div>
                    <div class="relative w-full sm:w-72 group">
                         <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" id="searchInput" placeholder="Cari menu lezat..." 
                        class="w-full py-3 pl-11 pr-4 text-gray-700 dark:text-white bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all shadow-inner font-medium">
                    </div>
                </div>

                <div class="flex space-x-3 overflow-x-auto pb-2 scrollbar-none" id="categoryTabs">
                    <button class="category-tab active px-6 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl text-sm font-bold transition-all shadow-md transform hover:scale-105 whitespace-nowrap" data-category="all">Semua Menu</button>
                    <button class="category-tab px-6 py-2.5 bg-white/80 dark:bg-gray-800/80 text-gray-600 dark:text-gray-300 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl text-sm font-bold hover:bg-brand-50 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 hover:border-brand-200 transition-all shadow-sm transform hover:scale-105 whitespace-nowrap" data-category="makanan">Makanan</button>
                    <button class="category-tab px-6 py-2.5 bg-white/80 dark:bg-gray-800/80 text-gray-600 dark:text-gray-300 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl text-sm font-bold hover:bg-brand-50 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 hover:border-brand-200 transition-all shadow-sm transform hover:scale-105 whitespace-nowrap" data-category="minuman">Minuman</button>
                    <button class="category-tab px-6 py-2.5 bg-white/80 dark:bg-gray-800/80 text-gray-600 dark:text-gray-300 border border-gray-200/50 dark:border-gray-700/50 rounded-2xl text-sm font-bold hover:bg-brand-50 dark:hover:bg-brand-900/30 hover:text-brand-600 dark:hover:text-brand-400 hover:border-brand-200 transition-all shadow-sm transform hover:scale-105 whitespace-nowrap" data-category="snack">Snack</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-20 overflow-y-auto pr-2" id="productGrid">
                @foreach($products as $product)
                    <div class="product-card bg-white/80 dark:bg-gray-800/80 backdrop-blur-md rounded-[2rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-white/50 dark:border-gray-700/50 hover:shadow-[0_8px_30px_rgba(239,68,68,0.15)] hover:-translate-y-2 transition-all duration-300 overflow-hidden cursor-pointer group select-none h-full flex flex-col relative"
                        data-name="{{ strtolower($product->name) }}" data-category="{{ $product->category }}"
                        onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }}, '{{ $product->category }}')">
                        
                        <!-- Image Area -->
                        <div class="h-48 bg-gray-50/50 dark:bg-gray-900/50 flex items-center justify-center relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            @else
                                <!-- Placeholder Icon -->
                                <div class="text-orange-300 group-hover:text-brand-400 transition-colors transform group-hover:scale-110 duration-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 opacity-50" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock <= 0)
                                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-[4px] flex items-center justify-center">
                                    <span class="bg-red-600/90 text-white text-xs font-black px-4 py-2 rounded-full shadow-[0_0_20px_rgba(239,68,68,0.6)] border border-red-500/50 tracking-widest uppercase rotate-[-15deg] scale-110">Habis</span>
                                </div>
                            @else
                                <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md shadow-lg px-3 py-1.5 rounded-xl text-xs font-bold text-gray-800 dark:text-gray-200 border border-white/50 dark:border-gray-600 flex items-center gap-1.5 transform group-hover:scale-105 transition-transform">
                                    <div class="w-2 h-2 rounded-full {{ $product->stock < 5 ? 'bg-red-500 animate-pulse shadow-[0_0_8px_rgba(239,68,68,0.8)]' : 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]' }}"></div>
                                    Stok: {{ $product->stock }}
                                </div>
                            @endif
                        </div>

                        <!-- Content Area -->
                        <div class="p-6 flex flex-col flex-grow relative bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm z-10 -mt-2 rounded-t-3xl transition-transform duration-300 group-hover:-translate-y-2">
                            <!-- Category Badge -->
                            <div class="mb-3">
                                <span class="text-[10px] font-black uppercase tracking-widest text-brand-500 border border-brand-100 dark:border-brand-900/50 px-3 py-1 rounded-full bg-brand-50 dark:bg-brand-900/20">
                                    {{ $product->category }}
                                </span>
                            </div>

                            <h3 class="font-extrabold text-gray-900 dark:text-white text-lg leading-tight mb-2 line-clamp-2 group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors">{{ $product->name }}</h3>
                            
                            <div class="mt-auto flex items-center justify-between pt-4">
                                <p class="text-brand-600 dark:text-brand-400 font-black text-xl tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                
                                <div class="w-10 h-10 rounded-2xl bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-300 group-hover:bg-gradient-to-br group-hover:from-brand-500 group-hover:to-orange-500 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-[0_4px_15px_rgba(239,68,68,0.4)] group-hover:rotate-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:w-1/3 relative z-30 h-full flex flex-col">
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-[2rem] shadow-[0_8px_40px_rgba(0,0,0,0.08)] border border-white/50 dark:border-gray-700/50 overflow-hidden flex flex-col h-full ring-1 ring-black/5 dark:ring-white/10">
                <div class="bg-gradient-to-r from-brand-600 to-brand-500 p-5 text-white shadow-md shrink-0 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                    <div class="absolute -left-4 -bottom-4 w-24 h-24 bg-black/10 rounded-full blur-xl"></div>
                    <h2 class="text-xl font-black flex items-center tracking-wide relative z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 animate-bounce" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Keranjang Pesanan
                    </h2>
                </div>

                <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm" class="flex flex-col flex-grow overflow-hidden" onsubmit="return prepareCartData()">
                    @csrf
                    <input type="hidden" name="cart_items" id="cart_items_input">
                    <input type="hidden" name="paid_amount" id="paid_amount_input">
                    <input type="hidden" name="change_amount" id="change_amount_input">

                    <div id="cart-scroll-area" class="flex-grow overflow-y-auto p-5 space-y-3 bg-gray-50/50 dark:bg-gray-900/50">
                        <div id="empty-cart-message" class="flex flex-col items-center justify-center h-full text-gray-400 dark:text-gray-500 py-10">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-bold tracking-wide text-gray-500 dark:text-gray-400">Keranjang Masih Kosong</p>
                            <p class="text-xs mt-1 text-gray-400">Pilih menu lezat di samping</p>
                        </div>
                        
                        <div id="cart-items-list" class="space-y-3 hidden"></div>
                    </div>

                    <div class="px-5 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-t border-gray-100 dark:border-gray-700/50 space-y-4 shrink-0">
                        
                        <div>
                            <label class="block text-[10px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-1.5">Nama Pelanggan</label>
                            <input type="text" name="customer_name" id="customer_name" required placeholder="Masukkan nama..."
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all dark:text-white">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-2">Tipe Pesanan</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="order_type" value="dine_in" class="peer sr-only" checked onchange="toggleTableInput()">
                                    <div class="text-center py-2.5 px-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 peer-checked:bg-brand-50 dark:peer-checked:bg-brand-900/30 peer-checked:border-brand-500 peer-checked:text-brand-600 dark:peer-checked:text-brand-400 transition-all shadow-sm">
                                        🍽️ Dine In
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="order_type" value="take_away" class="peer sr-only" onchange="toggleTableInput()">
                                    <div class="text-center py-2.5 px-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 peer-checked:bg-brand-50 dark:peer-checked:bg-brand-900/30 peer-checked:border-brand-500 peer-checked:text-brand-600 dark:peer-checked:text-brand-400 transition-all shadow-sm">
                                        🥡 Take Away
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="table-input-container">
                            <label class="block text-[10px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-1.5">Nomor Meja</label>
                            <input type="number" name="table_number" id="table_number" placeholder="Contoh: 12" min="1"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all dark:text-white">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-brand-600 dark:text-brand-400 uppercase tracking-widest mb-2">Metode Pembayaran</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="payment_method" value="cash" class="peer sr-only" checked>
                                    <div class="text-center py-2.5 px-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/30 peer-checked:border-green-500 peer-checked:text-green-600 dark:peer-checked:text-green-400 transition-all shadow-sm">
                                        💵 Cash
                                    </div>
                                </label>
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="payment_method" value="qris" class="peer sr-only">
                                    <div class="text-center py-2.5 px-2 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 peer-checked:border-blue-500 peer-checked:text-blue-600 dark:peer-checked:text-blue-400 transition-all shadow-sm">
                                        📱 QRIS
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 shrink-0 z-20 shadow-[0_-10px_20px_rgba(0,0,0,0.03)] rounded-b-[2rem]">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-gray-500 dark:text-gray-400 font-bold text-sm tracking-wide">Total Tagihan</span>
                            <span class="font-black text-3xl text-gray-900 dark:text-white leading-none tracking-tight" id="cart-total">Rp 0</span>
                        </div>

                        <button type="button" id="checkout-btn" disabled onclick="openConfirmModal()"
                            class="w-full bg-gray-300 dark:bg-gray-700 text-white font-black py-4 px-6 rounded-2xl shadow-none cursor-not-allowed transition-all duration-300 text-sm uppercase tracking-widest flex justify-center items-center gap-2">
                             <span>Bayar Sekarang</span>
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                        
                        <div class="mt-4 text-center">
                             <a href="javascript:void(0)" onclick="clearCart()" class="text-xs text-gray-400 hover:text-brand-600 dark:hover:text-brand-400 font-bold transition-colors py-1 px-2 border-b border-transparent hover:border-brand-600 dark:hover:border-brand-400">Kosongkan Keranjang</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PREMIUM CONFIRMATION MODAL -->
    <div id="confirmModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop with Blur -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modal-backdrop"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal Panel -->
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md opacity-0 scale-95" id="modal-panel">
                    
                    <!-- Decorative Header -->
                    <div class="bg-gradient-to-r from-red-600 to-red-500 px-4 py-6 sm:px-6 relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                        <div class="absolute -left-6 -bottom-6 w-24 h-24 bg-black/5 rounded-full blur-xl"></div>
                        
                        <div class="flex items-center gap-4 relative z-10">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-white/20 backdrop-blur-md sm:mx-0">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <h3 class="text-xl font-bold leading-6 text-white" id="modal-title">Konfirmasi Pembayaran</h3>
                                <p class="text-red-100 text-sm mt-1">Cek kembali detail pesanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-4 py-5 sm:p-6 space-y-5">
                        
                        <!-- Customer Info Card -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 shadow-sm relative">
                            <div class="absolute top-0 right-0 -mt-2 -mr-2 w-4 h-4 bg-red-500 rounded-full animate-ping opacity-75"></div>
                            
                            <dl class="grid grid-cols-2 gap-x-4 gap-y-4 text-sm">
                                <div>
                                    <dt class="font-medium text-gray-500 mb-1">Nama Pelanggan</dt>
                                    <dd class="text-gray-900 font-bold text-lg" id="modal-customer-name">-</dd>
                                </div>
                                <div id="modal-table-row">
                                    <dt class="font-medium text-gray-500 mb-1">No. Meja</dt>
                                    <dd class="text-gray-900 font-bold text-lg bg-red-50 text-red-700 px-2 py-0.5 rounded-lg inline-block border border-red-100" id="modal-table-number">-</dd>
                                </div>
                                <div class="col-span-2 border-t border-dashed border-gray-200 pt-3 flex justify-between items-center">
                                    <dt class="font-medium text-gray-500">Metode Bayar</dt>
                                    <dd class="text-gray-900 font-bold flex items-center gap-2" id="modal-payment-method">
                                        <!-- JS will inject icon here -->
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- QRIS Section (Conditional) -->
                        <div id="modal-qris-section" class="hidden text-center bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <p class="text-sm font-bold text-blue-800 mb-2">Scan QRIS untuk Membayar</p>
                            <div class="bg-white p-2 inline-block border border-gray-200 rounded-xl shadow-sm">
                                <img src="{{ asset('images/qris.jpg') }}" alt="QRIS Code" class="w-48 object-contain">
                            </div>
                            <p class="text-[11px] text-blue-800 mt-2 font-bold uppercase tracking-wide">Boydo Saragih, Digital & Kreatif</p>
                            <p class="text-[10px] text-blue-600 font-mono mt-0.5">NMID: ID1026492882620</p>
                        </div>


                        <!-- Payment Inputs Section -->
                        <div id="payment-input-section" class="bg-white p-4 rounded-xl border border-gray-200 mt-2 shadow-sm">
                             <div class="mb-4">
                                <label for="cash_amount" class="block text-sm font-semibold text-gray-700 mb-1">Uang Diterima (Rp)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">Rp</span>
                                    </div>
                                    <input type="number" id="cash_amount" class="block w-full pl-10 pr-4 py-3 border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-lg font-bold" placeholder="0" oninput="calculateChange()">
                                </div>
                                <p id="payment-error" class="hidden mt-2 text-xs text-red-600 font-bold flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Uang tidak mencukupi!
                                </p>
                            </div>

                            <div class="flex justify-between items-center pt-3 border-t border-dashed border-gray-200">
                                <span class="text-gray-600 font-medium">Kembalian</span>
                                <span class="text-xl font-bold text-green-600" id="change-display">Rp 0</span>
                            </div>
                        </div>

                        <!-- Total Section -->
                        <div class="text-center pt-2">
                            <p class="text-sm text-gray-400 font-medium uppercase tracking-wide mb-1">Total Tagihan</p>
                            <div class="flex flex-col items-center justify-center" id="modal-price-container">
                                <!-- JS will populate this -->
                                <span class="text-3xl font-extrabold text-gray-900 tracking-tight">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 flex flex-col sm:flex-row-reverse gap-3 border-t border-gray-100">
                        <button type="button" id="btn-confirm-pay" onclick="submitTransaction()" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent bg-red-600 px-6 py-3 text-base font-bold text-white shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto sm:text-sm transition-all transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            Proses Bayar
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                        <button type="button" onclick="closeConfirmModal()" class="mt-3 w-full inline-flex justify-center items-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm transition-all">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('last_transaction_id'))
    <!-- ... (Success Modal tetap sama, boleh dirapikan nanti jika diminta) ... -->
    <div id="successModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900">Transaksi Berhasil!</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Transaksi telah disimpan. Apakah Anda ingin mencetak struk?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-col gap-2">
                    <button type="button" onclick="printReceipt({{ session('last_transaction_id') }})" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-900 text-base font-medium text-white hover:bg-gray-800 focus:outline-none sm:text-sm">
                        🖨️ Cetak Struk
                    </button>
                    <button type="button" onclick="closeSuccessModal()" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:text-sm">
                        Tutup & Transaksi Baru
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        // ... (Kode Javascript Cart dan Filter sebelumnya tetap ada di sini) ...
        // Global Cart State
        let cart = [];

        // Add Item Logic
        function addToCart(id, name, price, stock, category) {
            if (stock <= 0) {
                alert('Maaf, stok produk ini habis.');
                return;
            }

            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                if (existingItem.qty < stock) {
                    existingItem.qty++;
                } else {
                    alert('Stok maksimal tercapai untuk item ini (' + stock + ')');
                    return;
                }
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    stock: stock,
                    category: category,
                    qty: 1
                });
            }

            renderCart();
            if (navigator.vibrate) navigator.vibrate(50);
        }

        // Qty Update Logic
        function updateQty(id, change) {
            const item = cart.find(i => i.id === id);
            if (!item) return;

            const newQty = item.qty + change;

            if (newQty > item.stock) {
                alert('Stok tidak mencukupi');
                return;
            }

            if (newQty < 1) {
                if(confirm('Hapus item ini dari keranjang?')) {
                    removeFromCart(id);
                }
                return;
            }

            item.qty = newQty;
            renderCart();
        }

        // Remove Single Item
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            renderCart();
        }

        // Clear All
        function clearCart() {
            if (cart.length === 0) return;
            if(confirm('Yakin ingin mengosongkan semua pesanan?')) {
                cart = [];
                renderCart();
            }
        }

        // Core Render Function
        function renderCart() {
            const emptyMsg = document.getElementById('empty-cart-message');
            const itemsList = document.getElementById('cart-items-list');
            const totalEl = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');

            if (cart.length === 0) {
                emptyMsg.classList.remove('hidden');
                itemsList.classList.add('hidden');
                itemsList.innerHTML = ''; 
                totalEl.textContent = 'Rp 0';
                checkoutBtn.disabled = true;
                checkoutBtn.classList.remove('bg-brand-600', 'hover:bg-brand-700', 'shadow-lg');
                checkoutBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
                return;
            }

            emptyMsg.classList.add('hidden');
            itemsList.classList.remove('hidden');
            
            let html = '';
            let total = 0;
            let foodCount = 0;

            cart.forEach(item => {
                const subtotal = item.price * item.qty;
                total += subtotal;
                foodCount += item.qty;

                html += `
                    <div class="flex flex-col bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm relative group mb-3">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-sm font-black text-gray-900 dark:text-white leading-tight pr-6">${item.name}</h4>
                            <button type="button" onclick="removeFromCart(${item.id})" class="text-gray-300 dark:text-gray-500 hover:text-red-500 dark:hover:text-red-400 absolute top-3 right-3 p-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="flex justify-between items-end">
                            <div class="text-sm font-black text-brand-600 dark:text-brand-400">
                                Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.qty)}
                            </div>
                            <div class="flex items-center bg-gray-50 dark:bg-gray-900 rounded-xl p-1 gap-2 border border-gray-100 dark:border-gray-700">
                                <button type="button" onclick="updateQty(${item.id}, -1)" class="w-7 h-7 flex items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-700 dark:text-gray-300 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 font-bold text-lg leading-none active:scale-90 transition-all">-</button>
                                <span class="text-sm font-black w-6 text-center text-gray-900 dark:text-white">${item.qty}</span>
                                <button type="button" onclick="updateQty(${item.id}, 1)" class="w-7 h-7 flex items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-700 dark:text-gray-300 hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/30 font-bold text-lg leading-none active:scale-90 transition-all">+</button>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Discount Logic
            let discountHtml = '';
            // Store raw values for modal use
            let rawTotal = total;
            let rawDiscount = 0;
            let rawFinalTotal = total;

            if (foodCount >= 3) {
                rawDiscount = total * 0.1;
                rawFinalTotal = total - rawDiscount;
                
                discountHtml = `
                    <div class="flex justify-between items-center mb-1 text-green-600 text-xs font-bold bg-green-50 p-2 rounded border border-green-100">
                        <span>Diskon 10% (Beli 3 Menu)</span>
                        <span>- Rp ${new Intl.NumberFormat('id-ID').format(rawDiscount)}</span>
                    </div>
                `;
            } else if (foodCount > 0) {
                 discountHtml = `
                    <div class="text-xs text-gray-400 mb-1 text-right italic p-2">
                        Beli ${3 - foodCount} menu lagi untuk diskon 10%
                    </div>
                `;
            }

            itemsList.innerHTML = html;
            
            const existingDiscountMsg = document.getElementById('discount-msg');
            if(existingDiscountMsg) existingDiscountMsg.remove();
            
            // Build the string for Main Display (Sidebar)
            // We need to keep the structure clear here too
            let totalHtml = '';
            
            if(foodCount >= 3) {
                 // Show strikethrough original + big final
                 totalHtml = `
                    <div class="flex flex-col items-end">
                        <span class="text-xs line-through text-gray-400">Rp ${new Intl.NumberFormat('id-ID').format(rawTotal)}</span>
                        <span>Rp ${new Intl.NumberFormat('id-ID').format(rawFinalTotal)}</span>
                    </div>
                 `;
            } else {
                 totalHtml = 'Rp ' + new Intl.NumberFormat('id-ID').format(rawTotal);
            }
            totalEl.innerHTML = totalHtml;
            // Store raw values in dataset for easy retrieval by modal
            totalEl.dataset.rawTotal = rawTotal;
            totalEl.dataset.rawDiscount = rawDiscount;
            totalEl.dataset.rawFinal = rawFinalTotal;

            if(discountHtml) {
               const msgDiv = document.createElement('div');
               msgDiv.id = 'discount-msg';
               msgDiv.innerHTML = discountHtml;
               const footerDiv = totalEl.closest('.p-4'); 
               if(footerDiv) footerDiv.insertBefore(msgDiv, footerDiv.firstChild); 
            }

            checkoutBtn.disabled = false;
            checkoutBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            checkoutBtn.classList.add('bg-brand-600', 'hover:bg-brand-700', 'shadow-lg');
        }

        // --- FUNGSI BARU UNTUK INPUT MEJA ---
        function toggleTableInput() {
            const dineInRadio = document.querySelector('input[name="order_type"][value="dine_in"]');
            const tableInputContainer = document.getElementById('table-input-container');
            const tableInput = document.getElementById('table_number');

            if (dineInRadio && dineInRadio.checked) {
                if(tableInputContainer) tableInputContainer.classList.remove('hidden');
                if(tableInput) tableInput.required = true;
            } else {
                if(tableInputContainer) tableInputContainer.classList.add('hidden');
                if(tableInput) {
                    tableInput.required = false;
                    tableInput.value = ''; // Reset nilai jika ganti ke take away
                }
            }
        }

        // Panggil saat halaman dimuat untuk set initial state
        document.addEventListener('DOMContentLoaded', function() {
            toggleTableInput();
            // ... (Kode filter search yg lama) ...
             const searchInput = document.getElementById('searchInput');
            const categoryTabs = document.querySelectorAll('.category-tab');
            const productCards = document.querySelectorAll('.product-card');
            let currentCategory = 'all';
            let searchQuery = '';

            function filterProducts() {
                productCards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    const category = card.getAttribute('data-category');
                    const matchesSearch = name.includes(searchQuery);
                    const matchesCategory = currentCategory === 'all' || category === currentCategory;
                    
                    if (matchesSearch && matchesCategory) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            }

            if(searchInput) {
                searchInput.addEventListener('input', (e) => {
                    searchQuery = e.target.value.toLowerCase();
                    filterProducts();
                });
            }

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    categoryTabs.forEach(t => {
                        t.classList.remove('bg-gray-900', 'text-white');
                        t.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                    });
                    tab.classList.remove('bg-gray-900', 'text-gray-600', 'border', 'border-gray-200');
                    tab.classList.add('bg-gray-900', 'text-white');
                    currentCategory = tab.getAttribute('data-category');
                    filterProducts();
                });
            });
        });

        // Form Submit Handler
        function prepareCartData() {
            if (cart.length === 0) {
                alert('Keranjang belanja kosong!');
                return false;
            }
            
            // Validasi Nama
            const customerName = document.getElementById('customer_name').value;
            if(!customerName.trim()) {
                alert('Mohon isi nama pelanggan');
                return false;
            }

            // Validasi Meja jika Dine In
            const isDineIn = document.querySelector('input[name="order_type"][value="dine_in"]').checked;
            if(isDineIn) {
                const tableNum = document.getElementById('table_number').value;
                if(!tableNum) {
                    alert('Mohon isi nomor meja untuk Dine In');
                    return false;
                }
            }

            document.getElementById('cart_items_input').value = JSON.stringify(cart);
            return true;
        }

        // Modal Logic
        function openConfirmModal() {
            if (!prepareCartData()) return; 

            // Update Info Modal
            const customerName = document.getElementById('customer_name').value;
            document.getElementById('modal-customer-name').innerText = customerName;

            const isDineIn = document.querySelector('input[name="order_type"][value="dine_in"]').checked;
            const tableRow = document.getElementById('modal-table-row');
            if(isDineIn) {
                tableRow.style.display = 'block';
                document.getElementById('modal-table-number').innerText = document.getElementById('table_number').value;
            } else {
                tableRow.style.display = 'none';
            }

            // Set default values for hidden inputs
            document.getElementById('paid_amount_input').value = 0;
            document.getElementById('change_amount_input').value = 0;

            // Show Payment Method
            const isCash = document.querySelector('input[name="payment_method"][value="cash"]').checked;
            const paymentMethodEl = document.getElementById('modal-payment-method');
            if(isCash) {
                paymentMethodEl.innerHTML = '💵 Cash (Tunai)';
            } else {
                paymentMethodEl.innerHTML = '📱 QRIS';
            }

            // Show QRIS if selected
            const isQris = document.querySelector('input[name="payment_method"][value="qris"]').checked;
            const qrisSection = document.getElementById('modal-qris-section');
            if(isQris) {
                qrisSection.classList.remove('hidden');
            } else {
                qrisSection.classList.add('hidden');
            }
            
            // Payment Input Visibility
            const paymentInputSection = document.getElementById('payment-input-section');
            if(isCash) {
                paymentInputSection.classList.remove('hidden');
                // Reset input
                document.getElementById('cash_amount').value = '';
                document.getElementById('change-display').innerText = 'Rp 0';
                document.getElementById('payment-error').classList.add('hidden');
                // Disable button initially for cash
                document.getElementById('btn-confirm-pay').disabled = true;
                document.getElementById('btn-confirm-pay').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                paymentInputSection.classList.add('hidden');
                // Enable button for QRIS
                document.getElementById('btn-confirm-pay').disabled = false;
                document.getElementById('btn-confirm-pay').classList.remove('opacity-50', 'cursor-not-allowed');
            }

            // --- FIXED PRICE DISPLAY LOGIC ---
            const totalEl = document.getElementById('cart-total');
            // Get raw values from dataset (we added these in renderCart)
            const rawTotal = parseFloat(totalEl.dataset.rawTotal || 0);
            const rawDiscount = parseFloat(totalEl.dataset.rawDiscount || 0);
            const rawFinal = parseFloat(totalEl.dataset.rawFinal || 0);

            const priceContainer = document.getElementById('modal-price-container');
            let priceHtml = '';

            if(rawDiscount > 0) {
                // If there is discount, show detailed breakdown
                priceHtml = `
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm text-gray-400 line-through">Rp ${new Intl.NumberFormat('id-ID').format(rawTotal)}</span>
                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold">Hemat Rp ${new Intl.NumberFormat('id-ID').format(rawDiscount)}</span>
                    </div>
                    <span class="text-4xl font-extrabold text-gray-900 tracking-tight">Rp ${new Intl.NumberFormat('id-ID').format(rawFinal)}</span>
                `;
            } else {
                // Normal view
                priceHtml = `
                     <span class="text-4xl font-extrabold text-gray-900 tracking-tight">Rp ${new Intl.NumberFormat('id-ID').format(rawFinal)}</span>
                `;
            }
            priceContainer.innerHTML = priceHtml;


            // Animation handling
            const modal = document.getElementById('confirmModal');
            const backdrop = document.getElementById('modal-backdrop');
            const panel = document.getElementById('modal-panel');
            
            modal.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function calculateChange() {
            const cashInput = document.getElementById('cash_amount');
            const totalEl = document.getElementById('cart-total');
            const finalTotal = parseFloat(totalEl.dataset.rawFinal || 0);
            const cash = parseFloat(cashInput.value || 0);
            
            const changeDisplay = document.getElementById('change-display');
            const errorMsg = document.getElementById('payment-error');
            const confirmBtn = document.getElementById('btn-confirm-pay');

            // Hitung kembalian
            const change = cash - finalTotal;
            
            // Update hidden inputs
            document.getElementById('paid_amount_input').value = cash;
            document.getElementById('change_amount_input').value = change > 0 ? change : 0;

            if (cash < finalTotal) {
                // Kurang bayar
                confirmBtn.disabled = true;
                confirmBtn.classList.add('opacity-50', 'cursor-not-allowed');
                errorMsg.classList.remove('hidden');
                changeDisplay.innerText = 'Rp 0';
                changeDisplay.classList.remove('text-green-600');
                changeDisplay.classList.add('text-gray-400');
            } else {
                // Cukup
                confirmBtn.disabled = false;
                confirmBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                errorMsg.classList.add('hidden');
                changeDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
                changeDisplay.classList.remove('text-gray-400');
                changeDisplay.classList.add('text-green-600');
            }
        }

        function closeConfirmModal() {
            const modal = document.getElementById('confirmModal');
            const backdrop = document.getElementById('modal-backdrop');
            const panel = document.getElementById('modal-panel');

            // Reverse animation
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Wait for transition to finish
        }

        function submitTransaction() {
             // Add loading state
             const btn = document.querySelector('#modal-panel button[onclick="submitTransaction()"]');
             const originalContent = btn.innerHTML;
             btn.disabled = true;
             btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            
            document.getElementById('transactionForm').submit();
        }

        function printReceipt(transactionId) {
            const url = "{{ url('/transactions') }}/" + transactionId + "/print";
            const win = window.open(url, '_blank', 'width=400,height=600');
        }

        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            if(modal) modal.remove();
        }
    </script>

@endsection