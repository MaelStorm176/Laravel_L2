<?php

use Illuminate\Database\Seeder;

class Ingredients_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient')->insert([
            ['nom_i' => 'sauce tomate', 'prix_i' => 0.5, 'image' => 'images/img_seed/ingre1.jpg'],
            ['nom_i' => 'poulet', 'prix_i' => 1.0, 'image' => 'images/img_seed/ingre2.jpg'],
            ['nom_i' => 'pomme de terre', 'prix_i' => 1.0, 'image' => 'images/img_seed/ingre3.jpg'],
            ['nom_i' => 'oignon', 'prix_i' => 0.25, 'image' => 'images/img_seed/ingre4.jpg']     
        ]);
    }
}
