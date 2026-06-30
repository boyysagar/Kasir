<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric|min:100', // Harga valid minimal 100
            'stock' => 'required|integer|min:2',   // Stok minimal 2
            'category' => 'required|in:makanan,minuman,snack',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.unique' => 'Nama produk ini sudah ada! Mohon gunakan nama lain.',
            'name.required' => 'Nama produk wajib diisi.',
            'price.min' => 'Harga valid minimal Rp 100.',
            'stock.min' => 'Stok minimal harus 2 item.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'products';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName); // Store in storage/app/public/products
            $input['image'] = 'products/' . $imageName; // Path relative to public/storage
        }

        Product::create($input);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'price' => 'required|numeric|min:100', // Harga valid minimal 100
            'stock' => 'required|integer|min:2',   // Stok minimal 2
            'category' => 'required|in:makanan,minuman,snack',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.unique' => 'Nama produk ini sudah ada! Mohon gunakan nama lain.',
            'name.required' => 'Nama produk wajib diisi.',
            'price.min' => 'Harga valid minimal Rp 100.',
            'stock.min' => 'Stok minimal harus 2 item.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $input['image'] = 'products/' . $imageName;
        } else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
