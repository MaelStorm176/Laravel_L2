<?php

use Illuminate\Database\Seeder;

class Parametres_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parametres')->insert([
            ['nom' => 'PizzeriaNOM',
             'lien' => 'http://pizzeriaNom.fr',
             'telephone' => '03.94.15.75.34',
             'adresse' => 'n°112 rue de la gare',
             'codePostal' => 51100,
             'ville' => 'Reims']
        ]);
    }
}
