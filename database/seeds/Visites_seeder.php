<?php

use Illuminate\Database\Seeder;

class Visites_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=50; $i++){
            DB::table('visites')->insert([
                'ip' => rand(1,254).'.'.rand(1,254).'.'.rand(1,254).'.'.rand(1,254), 'created_at' => date('Y-m-d H:i:s', mktime(0,0,0,date('m'), date('d')-rand(0,400), date('Y'))),
            ]);
        }
    }
}
