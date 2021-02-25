<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Partner;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $limit = 20;

        for ($i = 0; $i < $limit; $i++) {
            Partner::create([
                'email' => $faker->unique()->email,
                'name' => $faker->unique()->company,
            ]);
        }
    }
}
