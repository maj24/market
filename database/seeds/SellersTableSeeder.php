<?php

use App\Address;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numOfProducts = 2;
        factory(\App\Seller::Class, $numOfProducts)->create();
    }
}
