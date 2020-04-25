<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pizza_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for ($i=1;$i<=10;$i++) {
            $prix = random_int(1,20);
            DB::table('pizza')->insert([
                'nom' => 'Pizza'.$i,
                'photo' => 'images/img_seed/'.$i.'.jpg',
                'categorie' => 'pizza',
                'description_courte' => Str::random(10),
                'description_longue' => Str::random(50),
                'statut' => 'Disponible',
                'nutrition' => $i,
                'prix' => $prix,
                'promo' => $prix
            ]);
        }
    }
}
