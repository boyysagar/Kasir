<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'name' => 'Mie Gamon Level 1',
                'price' => 12000,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Gamon Level 2',
                'price' => 12000,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Gamon Level 3',
                'price' => 13000,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Gamon Level 4',
                'price' => 13000,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Gamon Level 5',
                'price' => 15000,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
