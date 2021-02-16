<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 30;

        for ($i = 1; $i <= $limit; $i++) {

            Product::create([
                'name' => 'Product_' . $i,
                'price' => $faker->numberBetween(100, 1000),
                'vendor_id' => $faker->numberBetween(1,10),
            ]);
        }
    }
}
