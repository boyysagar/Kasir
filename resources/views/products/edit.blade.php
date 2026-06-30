@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Produk</h2>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Gambar Produk
                    </label>
                    <div class="flex items-center space-x-4">
                        @if($product->image)
                            <div class="shrink-0">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                    class="h-20 w-20 object-cover rounded-lg">
                            </div>
                        @endif
                        <input
                            class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white"
                            id="image" type="file" name="image" accept="image/*">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nama Produk
                    </label>
                    <input
                        class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        id="name" type="text" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                            Harga (Rp)
                        </label>
                        <input
                            class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            id="price" type="number" name="price" value="{{ $product->price }}" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                            Kategori
                        </label>
                        <select
                            class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white"
                            id="category" name="category" required>
                            <option value="makanan" {{ $product->category == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ $product->category == 'minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="snack" {{ $product->category == 'snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                        Stok
                    </label>
                    <input
                        class="shadow-sm appearance-none border rounded-lg w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        id="stock" type="number" name="stock" value="{{ $product->stock }}" required>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('products.index') }}"
                        class="text-gray-500 hover:text-gray-700 mr-4 font-medium">Batal</a>
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-lg focus:outline-none focus:shadow-outline transition-colors"
                        type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection