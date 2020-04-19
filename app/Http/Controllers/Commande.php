<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
class Commande extends Controller
{
    public function afficher_comm(){ //affichage du dernier commentaire
        $commande = DB::table('commande')->select('*')->where('statut_prepa','=','En cours')->get();
        $var = 1;
        foreach ($commande as $key){
            $id_p=$key->id;
            echo '
              <tr id="'.$id_p.'">
              <th scope="row">'.$var.'</th>
              <td>'.$key->nom_p.'</td>
              <td>'.$key->user_name.'</td>
              <td>'.$key->prix_p.' €</td>
              <td>'.$key->statut_p.'</td>
              <td>'.$key->created_at.'</td>
              <td>'.$key->statut_prepa.'<a class="" onclick="valider('.$id_p.')" style=float:right;margin-right:1em;cursor:pointer;"><i class="far fa-check-square"></i></a></td>
';$var ++;

        }
    }
    public function valider(Request $request){

        DB::table('commande')->where('id','=',$request['id'])->update(['statut_prepa'=>'Validé','updated_at'=>date('Y-m-d H:i:s')]);
        return redirect('/')->with('message','mon message');
    }
    public static function historique(){ //affichage du dernier commentaire
        $commande = DB::table('commande')->select('*')->where('statut_prepa','!=','En cours')->paginate(5);
        foreach ($commande as $key){
            $id_p=$key->id;
            echo '
                <tr>
              <th scope="row">'.$id_p.'</th>
              <td>'.$key->nom_p.'</td>
              <td>'.$key->user_name.'</td>
              <td>'.$key->prix_p.'</td>
              <td>'.$key->statut_p.'</td>
              <td>'.$key->created_at.'</td>
              <td>'.$key->updated_at.'</td>
              <td>'.$key->statut_prepa.'</td></tr>
';

        }
        echo $commande->links();
    }

}
