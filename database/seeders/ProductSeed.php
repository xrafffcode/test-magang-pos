<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_name' => 'Tolak Angin',
            'product_description' => 'Tolak Angin adalah obat herbal yang digunakan untuk membantu meredakan gejala flu dan masuk angin, seperti demam, pilek, batuk, sakit kepala, dan pegal-pegal.',
            'product_price_capital' => 10000,
            'product_price_sell' => 15000,
        ]);

        Product::create([
            'product_name' => 'Koyo Salonpas',
            'product_description' => 'Koyo Salonpas adalah obat luar yang digunakan untuk meredakan nyeri otot dan sendi, seperti nyeri punggung, nyeri bahu, nyeri sendi, dan nyeri otot.',
            'product_price_capital' => 15000,
            'product_price_sell' => 20000,
        ]);

        Product::create([
            'product_name' => 'Komix Obat Batuk',
            'product_description' => 'Komix Obat Batuk adalah obat yang digunakan untuk meredakan batuk kering dan batuk berdahak.',
            'product_price_capital' => 5000,
            'product_price_sell' => 10000,
        ]);

        Product::create([
            'product_name' => 'Bodrex',
            'product_description' => 'Bodrex adalah obat yang digunakan untuk meredakan sakit kepala, migrain, nyeri otot, nyeri gigi, dan demam.',
            'product_price_capital' => 5000,
            'product_price_sell' => 10000,
        ]);

        Product::create([
            'product_name' => 'Antangin',
            'product_description' => 'Antangin adalah obat herbal yang digunakan untuk membantu meredakan gejala flu dan masuk angin, seperti demam, pilek, batuk, sakit kepala, dan pegal-pegal.',
            'product_price_capital' => 10000,
            'product_price_sell' => 15000,
        ]);
    }
}
