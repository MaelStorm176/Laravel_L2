<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
class Commande extends Controller
{
    public function afficher_comm(){ //affichage du dernier commentaire
        $commande = DB::table('commande')->select('*')->where('statut_prepa','=','En cours')->get();

        $var = 1;
        foreach ($commande as $key){
            $products = DB::table('pizza')
                ->join('contenu_panier', 'pizza.id', '=', 'contenu_panier.id_pizza')
                ->where('contenu_panier.id_panier', '=' , $key->id_panier)
                ->select('contenu_panier.quantite','nom')
                ->get();
            echo '
              <tr id="'.$key->id.'">
              <th scope="row">'.$var.'</th>
              <td><button onclick="afficher('.$key->id.')">Afficher</button>
                <div id="div_'.$key->id.'" style="display: none">';
                    foreach ($products as $key2){
                        echo 'Pizza : '.$key2->nom.'</br>';
                        echo 'Quantite : '.$key2->quantite.'</br>';
                    }
            echo'
                </div>
              </td>
              <td>'.$key->user_email.'</td>
              <td>'.$key->prix_total.' €</td>
              <td>'.$key->statut_pay.'</td>
              <td>'.$key->created_at.'</td>
              <td>'.$key->statut_prepa.'<a class="" onclick="valider('.$key->id.')" style=float:right;margin-right:1em;cursor:pointer;"><i class="far fa-check-square"></i></a></td>';
                    $var ++;

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
