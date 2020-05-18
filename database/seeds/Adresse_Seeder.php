<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Adresse_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adresse')->insert([
            'id' => 1,
            'rue' => '12 rue de la pizzeria',
            'code_postal' => '51100',
            'ville' => 'Reims',
            'status' => 'principale',
        ]);
    }
}
