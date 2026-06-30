<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.index', compact('products'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input Lengkap
        $request->validate([
            'cart_items' => 'required',
            'payment_method' => 'required|in:cash,qris',
            'order_type' => 'required|in:dine_in,take_away',
            'customer_name' => 'required|string|max:255',
            'table_number' => 'nullable|required_if:order_type,dine_in', // Wajib jika Dine In
        ]);

        $cartItems = json_decode($request->cart_items, true);

        if (!$cartItems || count($cartItems) < 1) {
            return back()->with('error', 'Keranjang belanja kosong!');
        }

        $invoiceCode = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
        $totalTransaction = 0;
        $foodCount = 0;
        $lastTransaction = null;

        // Ambil Data Input
        $paymentMethod = $request->payment_method;
        $orderType = $request->order_type;
        $customerName = $request->customer_name;
        $tableNumber = $request->table_number;

        DB::transaction(function () use ($cartItems, $invoiceCode, &$totalTransaction, &$foodCount, $paymentMethod, $orderType, $customerName, $tableNumber, &$lastTransaction) {

            // Prefetch Products
            $productsInfo = [];
            foreach ($cartItems as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $productsInfo[$item['id']] = $product;
                    $foodCount += $item['qty'];
                }
            }

            // Hitung Diskon
            $discountMultiplier = 1.0;
            if ($foodCount >= 3) {
                $discountMultiplier = 0.9; // Diskon 10%
            }

            // Proses Simpan
            foreach ($cartItems as $item) {
                if (!isset($productsInfo[$item['id']]))
                    continue;

                $product = $productsInfo[$item['id']];

                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi!");
                }

                $finalSubtotal = ($product->price * $item['qty']) * $discountMultiplier;
                $totalTransaction += $finalSubtotal;

                // Create Transaction
                $lastTransaction = Transaction::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'total_price' => $finalSubtotal,
                    'invoice_code' => $invoiceCode,
                    'payment_method' => $paymentMethod,
                    'order_type' => $orderType,
                    'customer_name' => $customerName,
                    'table_number' => ($orderType == 'dine_in') ? $tableNumber : null,
                ]);

                // Kurangi Stok
                $product->decrement('stock', $item['qty']);
            }
        });

        $msg = 'Transaksi berhasil! Kode Invoice: ' . $invoiceCode;
        if ($foodCount >= 3) {
            $msg .= ' (Diskon 10% diterapkan)';
        }

        // Redirect KEMBALI ke INDEX (Kasir) agar popup muncul
        return redirect()->route('transactions.index')
            ->with('success', $msg)
            ->with('last_transaction_id', $lastTransaction ? $lastTransaction->id : null);
    }

    public function history()
    {
        // Group by Invoice Code
        $transactions = Transaction::where('user_id', auth()->id())
            ->select(
                'invoice_code',
                DB::raw('MAX(id) as id'), // For link generation
                DB::raw('MAX(created_at) as created_at'),
                DB::raw('MAX(customer_name) as customer_name'),
                DB::raw('SUM(total_price) as total_price'),
                DB::raw('SUM(quantity) as total_qty')
            )
            ->groupBy('invoice_code')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.history', compact('transactions'));
    }

    public function print(Transaction $transaction)
    {
        // Ambil semua item dengan invoice yang sama
        $items = Transaction::with('product')
            ->where('invoice_code', $transaction->invoice_code)
            ->get();

        return view('transactions.print', compact('transaction', 'items'));
    }
}