<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Feriee_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feriee')->insert([
            ['jour' => date('Y-m-d H:i:s'), 'midi' => 'Fermé', 'soir'=>'18h/23h'],
            ['jour' => date('Y-m-d H:i:s'), 'midi' => 'Fermé', 'soir'=>'Fermé'],
            ['jour' => date('Y-m-d H:i:s'), 'midi' => '10h/13h', 'soir'=>'Fermé'],
        ]);
    }
}
