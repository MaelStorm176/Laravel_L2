<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class Panier extends Controller
{
    public function creer()
    {
        DB::table('panier')->updateOrInsert([
            'user_id' => auth::user()->id,
            'type_panier' => FALSE
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
            return back()->with('errors',"Il y a une erreur avec l'ajout de votre article.");
        }
        /*********************************/
        $id_panier = DB::table('panier')
            ->where('user_id',"=",auth::user()->id)
            ->where('type_panier','=',FALSE)
            ->value('id');
        //Si l'utilisateur n'a pas de panier, on lui en creer un
        if(Empty($id_panier)){
            $this->creer();
        }

        $id_panier = DB::table('panier')
            ->where('user_id',"=",auth::user()->id)
            ->where('type_panier','=',FALSE)
            ->value('id');
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
                Session::flash('message','Cet article a été ajouté à votre panier');
                return back();
            }
        }
        DB::table('contenu_panier')->insert([
            'id_panier' => $id_panier,
            'id_pizza' => $id_pizza,
            'quantite' => $quantite
        ]);
        Session::flash('message','Cet article a été ajouté à votre panier');
        return back();
    }

    public function prix_total($products)
    {
        $somme = 0;
        foreach ($products as $key) {
            $somme += ($key->promo) * ($key->quantite);
        }
        return $somme;
    }

    public function afficher()
    {
        if (auth::check()) {//Si le user est loggé
            $products = $this->get_products();
            $prix_total = $this->prix_total($products);
            $quantite_total = $this->quantite_total($products);
            return view('panier', compact('products', 'prix_total', 'quantite_total'));
        }
        return view('panier');
    }

    public function quantite_total($products)
    {
        $q_tot = 0;
        foreach ($products as $key)
        {
            $q_tot += $key->quantite;
        }
        return $q_tot;
    }

    public function get_products()
    {
        $id_panier = DB::table('panier')
            ->where('user_id',"=",auth::user()->id)
            ->where('type_panier','=',FALSE)
            ->value('id');
        $products = DB::table('pizza')
            ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
            ->where('contenu_panier.id_panier', '=' , $id_panier)
            ->select('promo','contenu_panier.quantite','nom','contenu_panier.id')
            ->get();
        return $products;
    }

    public function modifier(Request $request): void
    {
        //Validation de la requete
        $validate_data = Validator::make($request->all(), [
            'id' => 'required|integer',
            'value' => 'required|integer|between:1,100'
        ]);
        if($validate_data->fails()){
            //return back()->with('message',"Il y a une erreur avec la création de votre pizza.");
        }
        DB::table('contenu_panier')->where('id','=',$request['id'])->update(['quantite' => $request['value']]);
        $products = $this->get_products();
        echo $this->prix_total($products) . ' €' . '_|' . $this->quantite_total($products);
    }

    public function contenu_supprimer(Request $request)
    {
        DB::table('contenu_panier')->where('id','=',$request['id'])->delete();
        $products = $this->get_products();
        echo $this->prix_total($products) . ' €' . '_|' . $this->quantite_total($products);
    }
}
