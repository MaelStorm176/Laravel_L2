<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Panier_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for ($i=1;$i<=random_int(1,100);$i++) {
            DB::table('panier')->insert([
                'user_id' => $i,
                'type_panier' => 1
            ]);
            for($j=1;$j<random_int(1,10);$j++){
                DB::table('contenu_panier')->insert([
                    'id_panier' => $i,
                    'id_pizza' => random_int(1,10),
                    'quantite' => random_int(1,10)
                ]);
            }
        }
    }
}
