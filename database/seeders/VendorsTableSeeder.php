<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {

            Vendor::create([
                'emails' => $faker->unique()->email,
                'name' => $faker->unique()->company,
            ]);
        }
    }
}
