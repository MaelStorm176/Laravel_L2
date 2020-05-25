<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\auth;
class Commande extends Controller
{
    public function afficher_comm(Request $request){ //affichage du dernier commentaire
        if($request->ajax()) {
            if ($request['typeAction'] == 1) {
                $products = DB::table('pizza')
                    ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
                    ->where('contenu_panier.id_panier', '=', $request['idaffiche'])
                    ->select('contenu_panier.quantite', 'nom')
                    ->get();
                $menu = DB::table('menu')
                    ->join('contenu_panier', 'menu.id', '=', 'contenu_panier.id_menu')
                    ->where('contenu_panier.id_panier', '=', $request['idaffiche'])
                    ->select('promo', 'contenu_panier.quantite', 'nom', 'contenu_panier.id')
                    ->get();
                return view('historique_ajax', compact('request', 'products', 'menu'));
            } elseif ($request['typeAction'] == 0) {
                $commande = DB::table('commande')->where('statut_prepa', '=', 'En cours')->orderBy('created_at', 'asc')->get();
                return view('historique_ajax', compact('request', 'commande'));
            } else {
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }

    public function afficher_comm2(Request $request){ //affichage du dernier commentaire
        if($request->ajax()) {
            if ($request['typeAction'] == 1) {
                $products = DB::table('pizza')
                    ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
                    ->where('contenu_panier.id_panier', '=', $request['idaffiche'])
                    ->select('contenu_panier.quantite', 'nom')
                    ->get();
                $menu = DB::table('menu')
                    ->join('contenu_panier', 'menu.id', '=', 'contenu_panier.id_menu')
                    ->where('contenu_panier.id_panier', '=', $request['idaffiche'])
                    ->select('promo', 'contenu_panier.quantite', 'nom', 'contenu_panier.id')
                    ->get();
                return view('historique_ajax', compact('request', 'products', 'menu'));
            } elseif ($request['typeAction'] == 0) {
                $commande = DB::table('commande')->where('user_id', '=', auth::user()->id)->where('statut_prepa', '=', 'En cours')->orderBy('created_at', 'asc')->get();
                return view('historique_ajax2', compact('request', 'commande'));
            } else {
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }

    public function valider(Request $request){
        if($request->ajax()){
            DB::table('commande')->where('id','=',$request['id'])->update(['statut_prepa'=>'Validé','updated_at'=>date('Y-m-d H:i:s')]);
        }
        else{
            abort(404);
        }
    }
}
