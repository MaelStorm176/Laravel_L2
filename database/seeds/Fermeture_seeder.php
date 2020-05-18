<?php

use Illuminate\Database\Seeder;

class Fermeture_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fermeture')->insert([
            ['date_debut' => date('Y-m-d H:i:s'), 'date_fin' => date('Y-m-d H:i:s'), 'motif'=>'Vacances'],
            ['date_debut' => date('Y-m-d H:i:s'), 'date_fin' => date('Y-m-d H:i:s'), 'motif'=>'Vacances'],
            ['date_debut' => date('Y-m-d H:i:s'), 'date_fin' => date('Y-m-d H:i:s'), 'motif'=>'Personel'],
        ]);
    }
}
