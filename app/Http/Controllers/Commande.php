<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class Commande extends Controller
{
    public function afficher_comm(Request $request){ //affichage du dernier commentaire
        if($request['typeAction'] == 1)
        {
            $products = DB::table('pizza')
                ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
                ->where('contenu_panier.id_panier', '=' , $request['idaffiche'])
                ->select('contenu_panier.quantite','nom')
                ->get();
            $menu = DB::table('menu')
                ->join('contenu_panier', 'menu.id', '=', 'contenu_panier.id_menu')
                ->where('contenu_panier.id_panier', '=' , $request['idaffiche'])
                ->select('promo','contenu_panier.quantite','nom','contenu_panier.id')
                ->get();
            return view('historique_ajax',compact('request','products','menu'));
        }
        elseif ($request['typeAction'] == 0)
        {
            $commande = DB::table('commande')->orderBy('created_at','asc')->where('statut_prepa','=','En cours')->get();
            return view('historique_ajax',compact('request','commande'));
        }
        else
        {
            abort(404);
        }
    }
    public function valider(Request $request){
        DB::table('commande')->where('id','=',$request['id'])->update(['statut_prepa'=>'Validé','updated_at'=>date('Y-m-d H:i:s')]);
    }
    public static function historique(){ //affichage du dernier commentaire
        $commande = DB::table('commande')->select('*')->where('statut_prepa','!=','En cours')->paginate(5);
        foreach ($commande as $key){
            echo '
              <tr>
                  <th scope="row">'.$key->id.'</th>
                  <td><button>Afficher</button></td>
                  <td>'.$key->user_email.'</td>
                  <td>'.$key->prix_total.'</td>
                  <td>'.$key->statut_pay.'</td>
                  <td>'.$key->created_at.'</td>
                  <td>'.$key->updated_at.'</td>
                  <td>'.$key->statut_prepa.'</td>
              </tr>';

        }
        echo $commande->links();
    }

}
