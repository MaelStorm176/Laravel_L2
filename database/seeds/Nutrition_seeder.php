<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Nutrition_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for ($i=0;$i<10;$i++) {
            DB::table('nutrition')->insert([
                'Sodium' => random_int(0,100),
                'Fibres' => random_int(0,100),
                'Dont_satures' => random_int(0,100),
                'Lipides' => random_int(0,100),
                'Dont_sucres' => random_int(0,100),
                'Glucides' => random_int(0,100),
                'Proteines' => random_int(0,100),
                'Energies' => random_int(0,100),
            ]);
        }
    }
}
