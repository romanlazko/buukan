<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Cashier\Cashier;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stripe = Cashier::stripe();
        $products   = $stripe->products->all(['active' => true]);

        foreach ($products as $key => $product) {
            Product::updateOrCreate([
                'product_id' => $product->id,
            ],
            [
                'name' => $product->name,
                'type' => $product->metadata?->type,
                'active' => $product->active,
                'default_price' => $product->default_price,
                'description' => $product->description,
                'features' => json_encode($product->features),
                'metadata' => json_encode($product->metadata),
                'url' => $product->url,
            ]);
        }
    }
}
