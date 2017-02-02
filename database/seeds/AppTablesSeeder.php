<?php

use Illuminate\Database\Seeder;

use App\Seller;
use App\Product;
use App\Review;
use App\Tag;

class AppTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tags = factory(Tag::class,5)->create();
        $sellers = factory(Seller::class, 2)->create();
        foreach ($sellers as $seller) {
            $products = factory(Product::class, 3)->create([
              'seller_id' => $seller->id
            ])->each(function($product) {
              $product->tags()->sync(
                  App\Tag::all()->random(2)
                );
            });

            foreach ($products as $product) {
              factory(Review::class, 10)->create([
                'product_id' => $product->id
              ]);
            }
        }
    }
}
