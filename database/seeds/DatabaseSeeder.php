<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Nutrition_seeder::class);
        $this->call(Pizza_seeder::class);
        $this->call(Coupon_Seeder::class);
        $this->call(Carousel_seeder::class);
    }
}
