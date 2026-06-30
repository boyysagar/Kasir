@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Produk Baru</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Gambar Produk
                    </label>
                    <input
                        class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white"
                        id="image" type="file" name="image" accept="image/*">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama Produk
                    </label>
                    <input
                        class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        id="name" type="text" name="name" required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                            Harga (Rp)
                        </label>
                        <input
                            class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            id="price" type="number" name="price" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                            Kategori
                        </label>
                        <select
                            class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white"
                            id="category" name="category" required>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                        Stok Awal
                    </label>
                    <input
                        class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        id="stock" type="number" name="stock" required>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('products.index') }}"
                        class="text-gray-500 hover:text-gray-700 mr-4 font-medium">Batal</a>
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-lg focus:outline-none focus:shadow-outline transition-colors"
                        type="submit">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection