<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari input atau default ke hari ini
        $selectedDate = $request->input('date', now()->today()->format('Y-m-d'));

        // Konversi ke Carbon object untuk manipulasi mudah (opsional, tapi bagus untuk validasi)
        // $dateObj = \Carbon\Carbon::parse($selectedDate); 

        // 1. Total Penjualan (Filter Tanggal)
        $totalSales = Transaction::whereDate('created_at', $selectedDate)->sum('total_price');

        // 2. Produk Paling Laris (Filter Tanggal)
        $popularProduct = DB::table('transactions')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereDate('created_at', $selectedDate) // Filter tanggal juga di sini
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        $bestSellingProduct = null;
        if ($popularProduct) {
            $bestSellingProduct = Product::find($popularProduct->product_id);
            if ($bestSellingProduct) {
                $bestSellingProduct->total_sold = $popularProduct->total_sold;
            }
        }

        // 3. Transaksi (Filter Tanggal)
        // Menampilkan lebih banyak transaksi (misal 10) karena user mungkin ingin cek detail hari itu
        $recentTransactions = Transaction::with(['user', 'product'])
            ->whereDate('created_at', $selectedDate)
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('totalSales', 'bestSellingProduct', 'recentTransactions', 'selectedDate'));
    }
}
