<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Horaires_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semaine = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        for($i=0;$i<7;$i++) {
            DB::table('horaires')->insert([
                'jour' => $semaine[$i],
            ]);
        }
    }
}
