<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Minuman
        $drinks = [
            [
                'name' => 'Es Teh Manis Jumbo',
                'category' => 'minuman',
                'price' => 5000,
                'stock' => 100,
                'image' => null, // Placeholder will handle
            ],
            [
                'name' => 'Lemon Tea Segar',
                'category' => 'minuman',
                'price' => 7000,
                'stock' => 80,
                'image' => null,
            ],
            [
                'name' => 'Es Jeruk Peras',
                'category' => 'minuman',
                'price' => 8000,
                'stock' => 50,
                'image' => null,
            ],
            [
                'name' => 'Kopi Susu Gula Aren',
                'category' => 'minuman',
                'price' => 15000,
                'stock' => 40,
                'image' => null,
            ],
            [
                'name' => 'Air Mineral',
                'category' => 'minuman',
                'price' => 4000,
                'stock' => 200,
                'image' => null,
            ],
        ];

        // Snack
        $snacks = [
            [
                'name' => 'Dimsum Ayam (4 pcs)',
                'category' => 'snack',
                'price' => 12000,
                'stock' => 30,
                'image' => null,
            ],
            [
                'name' => 'Kentang Goreng Keju',
                'category' => 'snack',
                'price' => 10000,
                'stock' => 40,
                'image' => null,
            ],
            [
                'name' => 'Pangsit Goreng Viral',
                'category' => 'snack',
                'price' => 8000,
                'stock' => 60,
                'image' => null,
            ],
            [
                'name' => 'Roti Bakar Coklat',
                'category' => 'snack',
                'price' => 15000,
                'stock' => 20,
                'image' => null,
            ],
            [
                'name' => 'Udang Rambutan',
                'category' => 'snack',
                'price' => 18000,
                'stock' => 25,
                'image' => null,
            ],
        ];

        foreach (array_merge($drinks, $snacks) as $item) {
            Product::create($item);
        }
    }
}
