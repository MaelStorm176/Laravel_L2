<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Commentaire extends Controller
{

    public function voir(){
        return view('commentaire');

    }

    public function ajout(Request $request)
    {
        $user = auth()->user();
        if (!Empty($user->email_verified_at)) {
            $nb_commande = DB::table('commande')
                ->where('user_id','=', $user->id)
                ->where("statut_pay", "=", "Validé")
                ->count();

            $nb_commentaire = DB::table('commentaire')
                ->where('email','=', $user->email)
                ->count();

            if ($nb_commentaire < $nb_commande) {
                $validate_data = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'comm' => 'sometimes|required',
                    'value' => 'required|between:0,5'
                ]);

                if ($validate_data->fails() || $request['email'] != $user->email) {
                    echo "Il y a une erreur avec votre E-mail ou votre commentaire";
                } else {   //il faut checker si l'adresse mail rentrée  est la meme que celle en bas
                    DB::table("Commentaire")->insert([
                        'email' => $request["email"],
                        'username' => $user->username,
                        'commentaire' => $request["comm"],
                        'note' => $request["value"],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $commentaires = $this->com();
                return view('avis')->with('commentaires', $commentaires);
            }
            else {
                return back()->with('message', 'Vous ne pouvez pas mettre plus de commentaire.');
            }
        }
        else {
            return back()->with('message', 'Votre email doit être vérifié !');
        }
    }

    public function clear_db()
    {
        Db::table('Commentaire')->delete();
        return back()->with('message','Base de commentaire vidée');
    }

    public function afficher(Request $request) { //affichage du dernier commentaire
        $choix = $request["choix"];
        if($choix == "moins") {
            $com = DB::table('commentaire')
                ->orderBy('note', 'asc')
                ->paginate(5);
        }
        else if ($choix == "mieux") {
            $com = DB::table('commentaire')
                ->orderBy('note', 'desc')
                ->paginate(5);
        }
        else {
            $com = $this->com();
        }
        $com->withPath('afficher?choix='.$choix);
        return view('avis')->with("commentaires", $com);
    }

    public function com() {
        $com = DB::table("commentaire")
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return $com;
    }

    public function afficherdefaut() {
        $com = $this->com();

        return view('avis')->with("commentaires", $com);
    }

}
