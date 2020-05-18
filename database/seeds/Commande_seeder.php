<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Commande_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $nb_panier = DB::table('panier')->count('id');
        for ($i = 1; $i <= $nb_panier; $i++) {
            $prix_total = 0;
            $products = DB::table('pizza')
                ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
                ->where('contenu_panier.id_panier', '=' , $i)
                ->select('promo','contenu_panier.quantite')
                ->get();
            foreach ($products as $key)
            {
                $prix_total+=$key->promo * $key->quantite;
            }

            DB::table('commande')->insert([
                'prix_total' => $prix_total,
                'num_commande' => 'com_'.$i.'_'.$prix_total.'_'.time(),
                'user_id' => $i,
                'id_panier'=>$i,
                'statut_pay' => 'Validé',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
