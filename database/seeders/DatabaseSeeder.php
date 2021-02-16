<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            VendorsTableSeeder::class,
            ProductsTableSeeder::class,
            PartnersTableSeeder::class,
            OrdersTableSeeder::class,
            OrdersProductsTableSeeder::class
        ]);
    }
}
