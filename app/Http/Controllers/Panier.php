<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Validator;


class Panier extends Controller
{
    public function creer()
    {
        DB::table('panier')->updateOrInsert([
            'user_id' => auth::user()->id,
            'payer' => FALSE,
            'id_commande' => auth::user()->id
        ]);

        $id_panier = DB::table('panier')->where('user_id',"=",auth::user()->id)->value('id');
        auth::user()->update([
            'id_panier' => $id_panier
        ]);
    }


    public function ajouter(Request $request)
    {
        //Validation de la requete
        $validate_data = Validator::make($request->all(), [
            'id_pizza' => 'required|integer',
            'quantite' => 'required|integer|between:1,100'
        ]);
        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la création de votre pizza.");
        }
        /*********************************/

        //Si l'utilisateur n'a pas de panier, on lui en creer un
        if(auth::user()->id_panier == NULL){
            $this->creer();
        }

        $id_panier = DB::table('panier')->where('user_id',"=",auth::user()->id)->value('id');
        $pizza_and_quantite = DB::table('contenu_panier')->where('id_panier',"=",$id_panier)->select('id_pizza','quantite')->get();
        $id_pizza = $request['id_pizza'];
        $quantite = $request['quantite'];

        //On parcourt la colonne des id de pizza pour savoir si on a deja commander une pizza de cette sorte
        foreach ($pizza_and_quantite as $key) {
            if($key->id_pizza == $id_pizza){
                $somme = $key->quantite + $quantite;
                DB::table('contenu_panier')->where('id_pizza','=',$id_pizza)->update([
                    'quantite' => $somme
                ]);
                return back();
            }
        }
        DB::table('contenu_panier')->insert([
            'id_panier' => $id_panier,
            'id_pizza' => $id_pizza,
            'quantite' => $quantite
        ]);
        return back();
    }

    public function prix_total()
    {
        $id_panier = auth::user()->id_panier;
        $quantite = DB::table('contenu_panier')->where('id_panier',"=",$id_panier)->select('quantite')->get();

        $products = DB::table('pizza')
            ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('promo','contenu_panier.quantite')
            ->get();
        $somme = 0;
        foreach ($products as $key) {
            $somme += ($key->promo) * ($key->quantite);
        }
        return $somme;
    }

    public function afficher()
    {
        $id_panier = DB::table('panier')->where('user_id',"=",auth::user()->id)->value('id');
        $products = DB::table('pizza')
            ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('promo','contenu_panier.quantite','nom','contenu_panier.id')
            ->get();

        $prix_total = $this->prix_total();
        return view('panier',compact('products','prix_total'));
    }

    public function modifier(Request $request)
    {
        //Validation de la requete
        $validate_data = Validator::make($request->all(), [
            'id_pizza' => 'required|integer',
            'quantite' => 'required|integer|between:1,100'
        ]);
        if($validate_data->fails()){
            return back()->with('message',"Il y a une erreur avec la création de votre pizza.");
        }
    }
}
