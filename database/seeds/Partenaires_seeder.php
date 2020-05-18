<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Partenaires_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partenaires')->insert([
            ['nom' => 'google', 'lien' => 'https://www.google.com'],
            ['nom' => 'pizza match', 'lien' => 'https://fr.pizzamatch.com/'],
            ['nom' => 'La fac de Reims', 'lien' => 'https://www.univ-reims.fr/']
        ]);
    }
}
