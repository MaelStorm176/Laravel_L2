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
            ['telephone' => '03.94.15.75.34',
             'adresse' => 'n°112 rue de la gare',
             'codePostal' => 51100,
             'ville' => 'Reims',
             'iframe' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.004943824818!2d4.1130172159140965!3d49.2952494778007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e99d86f90099cd%3A0x33bb405513e3549d!2sPlace%20de%20la%20Gare%2C%2051100%20Reims!5e0!3m2!1sfr!2sfr!4v1588795280366!5m2!1sfr!2sfr',
             'facebook' => 'https://www.facebook.com/',
             'twitter' => 'https://twitter.com/',
             'ptsEquivalent' => '1',
             'ptsGain' => '10',
             'ptsNbComm' => '15']
        ]);
    }
}
