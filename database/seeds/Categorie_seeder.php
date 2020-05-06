<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categorie_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['pizzas', 'desserts', 'boissons'];
        foreach ($categories as $key)
        {
            DB::table('categorie')->insert(['nom' => $key]);
        }
    }
}
