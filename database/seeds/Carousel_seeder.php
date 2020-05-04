<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Carousel_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<4;$i++)
        {
            DB::table('accueil_carousel')->insert([
                'image_carousel' => 'images/img_seed/car_'.$i.'.jpg',
                'titre_carousel' => 'Carousel_'.$i,
            ]);
        }
    }
}
